<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View|JsonResponse
    {
        Gate::authorize('accessable');

        if (request()->ajax()) {
            $daftarRole = Role::query();

            return datatables($daftarRole)
                ->addIndexColumn()
                ->editColumn('Aksi', function ($data) {
                    $buttons = "<button class='btn btn-primary btn-edit mx-1' data-id='{$data->IdRole}' data-nama='{$data->Nama}'><i class='fa-solid fa-edit mr-2'></i>Ubah</button>";
                    $buttons .= "<button class='btn btn-danger btn-delete mx-1' data-id='{$data->IdRole}' data-nama='{$data->Nama}'><i class='fa-solid fa-trash mr-2'></i>Hapus</button>";

                    return $buttons;
                })
                ->rawColumns(['Aksi'])
                ->toJson();
        }

        return view('admin.admin.role');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            Role::create([
                'Nama' => $request->nama,
            ]);

            toast('Berhasil menambahkan role baru!', 'success');

            return back();
        } catch (\Throwable $th) {
            if (! app()->isProduction()) {
                toast('Gagal menambahkan role baru!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal menambahkan role baru!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            $role->update([
                'Nama' => $request->nama,
            ]);

            toast('Berhasil memperbarui role!', 'success');

            return back();
        } catch (\Throwable $th) {
            if (! app()->isProduction()) {
                toast('Gagal memperbarui role!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal memperbarui role!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function destroy(Role $role): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            $role->delete();
            toast('Berhasil menghapus role!', 'success');

            return back();
        } catch (\Throwable $th) {
            $msg = 'Gagal menghapus role!';
            if ($role->Menu()->count() > 0) {
                $msg .= '<br>Masih ada menu yang membutuhkan role ini!';
            } elseif ($role->User()->count() > 0) {
                $msg .= '<br>Masih ada user yang menggunakan role ini!';
            }

            if (! app()->isProduction()) {
                toast("$msg<br>(terjadi: ".date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast("$msg<br>(terjadi: ".date('Y-m-d H:i:s').')', 'error');
            }

            return back();
        }
    }
}
