<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrivilegeRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PrivilegeController extends Controller
{
    public function index(): View|JsonResponse
    {
        Gate::authorize('accessable');

        if (request()->ajax()) {
            $daftarPrivilege = DB::table('Privilege', 'RP')
                ->join('Role AS R', 'RP.IdRole', '=', 'R.IdRole')
                ->join('Menu AS M', 'RP.IdMenu', '=', 'M.IdMenu')
                ->select(['R.IdRole', 'R.Nama AS Role', 'M.IdMenu', 'M.Judul AS Menu', 'M.RouteName', 'RP.Level']);

            return datatables($daftarPrivilege)
                ->addIndexColumn()
                ->editColumn('Menu', function ($data) {
                    $menu = $data->Menu;
                    $menu .= "<br><small>$data->RouteName</small>";

                    return $menu;
                })
                ->editColumn('Aksi', function ($data) {
                    $button = "<button class='btn btn-danger btn-delete mx-1' data-role='{$data->IdRole}' data-menu='{$data->IdMenu}'><i class='fa-solid fa-trash mr-2'></i>Hapus</button>";

                    return $button;
                })
                ->rawColumns(['Menu', 'Aksi'])
                ->toJson();
        }

        return view('admin.admin.privilege');
    }

    public function store(PrivilegeRequest $request): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $roles = collect($request->role)->filter()->toArray();
            $tempMenus = collect($request->menu)->filter()->toArray();
            foreach ($tempMenus as $menu) {
                $menus[$menu] = ['Level' => $request->level];
            }

            foreach ($roles as $role) {
                Role::find($role)->Menu()->syncWithoutDetaching($menus);
            }

            DB::commit();

            toast('Berhasil menambahkan privilege baru!', 'success');

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal menambahkan privilege baru!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal menambahkan privilege baru!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function destroy(int $role, int $menu): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::table('Privilege')->where(['IdRole' => $role, 'IdMenu' => $menu])->delete();

            toast('Berhasil menghapus privilege!', 'success');

            return back();
        } catch (\Throwable $th) {
            if (! app()->isProduction()) {
                toast('Gagal menghapus privilege!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal menghapus privilege!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back();
        }
    }
}
