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
            $daftarUser = User::with('Role');

            return datatables($daftarUser)
                ->addIndexColumn()
                ->editColumn('role', fn ($user) => $user->Role?->pluck('Nama')->implode(', '))
                ->editColumn('Aksi', fn ($user) => "<a href='".route('admin.user.edit', $user)."' class='btn btn-primary mx-1'><i class='fa-solid fa-edit mr-2'></i>Ubah</a>")
                ->rawColumns(['Aksi'])
                ->toJson();
        }

        return view('admin.admin.user.index');
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

            DB::table('UserRole')->where('IdUser', $user->id)->delete();

            foreach ($request->validated()['Role'] as $role) {
                DB::table('UserRole')->insert([
                    'IdUser' => $user->id,
                    'IdRole' => $role,
                ]);
            }

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
