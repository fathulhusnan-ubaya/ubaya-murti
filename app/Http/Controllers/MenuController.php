<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View|JsonResponse
    {
        Gate::authorize('accessable');

        if (request()->ajax()) {
            $daftarMenu = Menu::with(['Parent']);

            return datatables($daftarMenu)
                ->addIndexColumn()
                ->editColumn('MenuInduk', fn ($menu) => $menu->Parent->Judul ?? '-')
                ->editColumn('IsAktif', fn ($menu) => match ($menu->IsAktif) {
                    true => "<span class='badge bg-primary text-white'>Aktif</span>",
                    default => "<span class='badge bg-danger text-white'>Tidak Aktif</span>",
                })
                ->editColumn('Aksi', function ($menu) {
                    $buttons = str($menu->RouteName)->contains('*') ? '' : ('<a href='.route($menu->RouteName, $menu->RouteParam)." class='btn btn-warning mx-1'><i class='fa-solid fa-door-open mr-2'></i>Ke Menu</a>");
                    $buttons .= "<a href='".route('admin.menu.edit', $menu)."' class='btn btn-primary mx-1'><i class='fa-solid fa-edit mr-2'></i>Ubah</a>";
                    $buttons .= "<button class='btn btn-danger btn-delete mx-1' data-id='{$menu->IdMenu}' data-nama='{$menu->Judul}'><i class='fa-solid fa-trash mr-2'></i>Hapus</button>";

                    return $buttons;
                })
                ->rawColumns(['IsAktif', 'Aksi'])
                ->toJson();
        }

        return view('admin.admin.menu.index');
    }

    public function create(): View
    {
        Gate::authorize('accessable');

        $daftarRoute = $this->getRoutes();
        $daftarInduk = Menu::where('IdMenuParent', null)->pluck('Judul', 'IdMenu');
        $noUrutTanpaInduk = Menu::where('IdMenuParent', null)->max('Urutan') + 1;

        return view('admin.admin.menu.detail', compact('daftarRoute', 'daftarInduk', 'noUrutTanpaInduk'));
    }

    public function store(MenuRequest $request): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $route_params = null;
            if ($request->has('route_param_key')) {
                foreach ($request->route_param_key as $key => $route_key) {
                    $route_params[$route_key] = $request->route_param_value[$key];
                }
            }

            // Observer 'creating' running here ...

            $menu = Menu::create([
                'Judul' => $request->judul,
                'RouteName' => $request->route_name,
                'RouteParams' => $route_params,
                'Urutan' => $request->urutan,
                'IsAktif' => $request->boolean('is_aktif'),
                'Icon' => $request->icon,
                'IdMenuParent' => $request->induk,
            ]);

            DB::commit();

            session()->forget('my');
            auth()->user()->retrieveSession();

            toast('Berhasil menambahkan menu baru!', 'success');

            return to_route('admin.menu.edit', $menu);
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal menambahkan menu baru!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal menambahkan menu baru!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function edit(Menu $menu): View
    {
        Gate::authorize('accessable');

        $daftarRoute = $this->getRoutes();
        $daftarInduk = Menu::where('IdMenuParent', null)->pluck('Judul', 'IdMenu');
        $noUrutTanpaInduk = Menu::where('IdMenuParent', null)->max('Urutan');

        return view('admin.admin.menu.detail', compact('daftarRoute', 'daftarInduk', 'menu', 'noUrutTanpaInduk'));
    }

    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $route_params = null;
            if ($request->has('route_param_key')) {
                foreach ($request->route_param_key as $key => $route_key) {
                    $route_params[$route_key] = $request->route_param_value[$key];
                }
            }

            // Observer 'updating' running here ...

            $menu->update([
                'Judul' => $request->judul,
                'RouteName' => $request->route_name,
                'RouteParams' => $route_params,
                'Urutan' => $request->urutan,
                'IsAktif' => $request->boolean('is_aktif'),
                'Icon' => $request->icon,
                'IdMenuParent' => $request->induk,
            ]);

            DB::commit();

            session()->forget('my');
            auth()->user()->retrieveSession();

            toast('Berhasil memperbarui menu baru!', 'success');

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal memperbarui menu!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal memperbarui menu!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();
            // Observer 'deleting' running here ...
            $menu->delete();
            DB::commit();

            session()->forget('my');
            auth()->user()->retrieveSession();

            toast('Berhasil menghapus menu!', 'success');

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            $msg = 'Gagal menghapus menu!';
            if ($menu->Submenu()->count() > 0) {
                $msg .= '<br>Masih ada submenu di menu ini!';
            } elseif ($menu->Privilege()->count() > 0) {
                $msg .= '<br>Masih ada role privilege yang membutuhkan menu ini!';
            }

            if (! app()->isProduction()) {
                toast("$msg<br>(terjadi: ".date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast("$msg<br>(terjadi: ".date('Y-m-d H:i:s').')', 'error');
            }

            return back();
        }
    }

    private function getRoutes()
    {
        $routes = collect(Route::getRoutes()->getRoutes())
            ->map(fn ($route) => in_array('GET', $route->methods) ? $route->action : null)
            ->pluck('as')->filter()->values()->toArray();

        $temp = $routes;
        $routes = [];
        foreach ($temp as $route) {
            $routes[$route] = $route;
            $names = explode('.', $route);
            $route = '';
            for ($i = 0; $i < count($names) - 1; $i++) {
                $route .= $names[$i].'.';
                $routes[$route.'*'] = $route.'*';
            }
        }

        return collect($routes)->sort()->toArray();
    }

    public function getUrutan(int $IdMenu)
    {
        abort_if(! request()->ajax(), 404);

        return Menu::where('IdMenuParent', $IdMenu)->orderByDesc('Urutan')->first()['Urutan'] ?? 0;
    }
}
