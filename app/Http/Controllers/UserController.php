<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View|JsonResponse
    {
        Gate::authorize('accessable');

        if (request()->ajax()) {
            $daftarUser = User::query();

            return datatables($daftarUser)
                ->addIndexColumn()
                ->editColumn('Aksi', function ($user) {
                    $buttons = "<a href='".route('admin.user.edit', $user)."' class='btn btn-primary mx-1'><i class='fa-solid fa-edit mr-2'></i>Ubah</a>";
                    $buttons .= "<button class='btn btn-danger btn-delete mx-1' data-id='{$user->IdUser}' data-nama='{$user->Nama}'><i class='fa-solid fa-trash mr-2'></i>Hapus</button>";

                    return $buttons;
                })
                ->rawColumns(['Aksi'])
                ->toJson();
        }

        return view('admin.admin.user.index');
    }

    public function create(): View
    {
        Gate::authorize('accessable');

        $daftarRole = Role::pluck('Nama', 'IdRole');

        return view('admin.admin.user.detail', compact('daftarRole'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $user = User::create([
                'Username' => $request->username,
                'Nama' => $request->nama,
                'Email' => $request->email,
                'Password' => Hash::make($request->password),
            ]);

            $user->Role()->sync($request->validated()['Role']);

            DB::commit();

            toast('Berhasil menambahkan user baru!', 'success');

            return to_route('admin.user.edit', $user);
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal menambahkan user baru!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal menambahkan user baru!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back();
        }
    }

    public function edit(User $user): View
    {
        Gate::authorize('accessable');

        $daftarRole = Role::pluck('Nama', 'IdRole');

        return view('admin.admin.user.detail', compact('user', 'daftarRole'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $update = [
                'Nama' => $request->nama,
            ];

            if ($request->password) {
                $update['Password'] = Hash::make($request->password);
            }

            $user->update($update);

            $user->Role()->sync($request->validated()['Role']);

            DB::commit();

            toast('Berhasil memperbarui user!', 'success');

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal memperbarui user!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal memperbarui user!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back();
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();
            $user->Role()->detach();
            $user->delete();
            DB::commit();

            session()->forget('my');
            auth()->user()->retrieveSession();

            toast('Berhasil menghapus user!', 'success');

            return back();
        } catch (\Throwable $th) {
            $msg = 'Gagal menghapus user!';
            if ($user->Role()->count() > 0) {
                $msg .= '<br>User sudah digunakan!';
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
