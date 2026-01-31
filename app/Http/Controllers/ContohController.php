<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContohRequest;
use App\Models\ContohModel;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ContohController extends Controller
{
    public function index(): View|JsonResponse
    {
        Gate::authorize('accessable');

        if (request()->ajax()) {
            $daftarData = ContohModel::with(['Parent']);

            return datatables($daftarData)
                ->addIndexColumn()
                ->editColumn('Aksi', function ($contoh) {
                    $buttons = "<a href='".route('contoh.edit', $contoh)."' class='btn btn-primary mx-1'><i class='fa-solid fa-edit mr-2'></i>Ubah</a>";
                    $buttons .= "<button class='btn btn-danger btn-delete mx-1' data-id='{$contoh->IdContoh}' data-nama='{$contoh->Nama}'><i class='fa-solid fa-trash mr-2'></i>Hapus</button>";

                    return $buttons;
                })
                ->rawColumns(['Aksi'])
                ->toJson();
        }

        return view('admin.contoh.index');
    }

    public function create(): View
    {
        Gate::authorize('accessable');

        return view('admin.contoh.detail');
    }

    public function store(ContohRequest $request): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $menu = ContohModel::create([
                'Nama' => $request->nama,
            ]);

            DB::commit();

            toast('Berhasil menambahkan data baru!', 'success');

            return to_route('contoh.edit', $menu);
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal menambahkan data baru!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal menambahkan data baru!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function edit(ContohModel $contoh): View
    {
        Gate::authorize('accessable');

        return view('admin.contoh.detail', compact('contoh'));
    }

    public function update(ContohRequest $request, ContohModel $contoh): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();

            $contoh->update([
                'Nama' => $request->nama,
            ]);

            DB::commit();

            session()->forget('my');
            auth()->user()->retrieveSession();

            toast('Berhasil memperbarui data!', 'success');

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (! app()->isProduction()) {
                toast('Gagal memperbarui data!<br>(terjadi: '.date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast('Gagal memperbarui data!<br>(terjadi: '.date('Y-m-d H:i:s').')', 'error');
            }

            return back()->withInput();
        }
    }

    public function destroy(ContohModel $contoh): RedirectResponse
    {
        Gate::authorize('accessable');

        try {
            DB::beginTransaction();
            // Observer 'deleting' running here ...
            $contoh->delete();
            DB::commit();

            session()->forget('my');
            auth()->user()->retrieveSession();

            toast('Berhasil menghapus data!', 'success');

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            $msg = 'Gagal menghapus data!';

            if (! app()->isProduction()) {
                toast("$msg<br>(terjadi: ".date('Y-m-d H:i:s').')'.'<br>'.$th->getMessage(), 'error');
            } else {
                toast("$msg<br>(terjadi: ".date('Y-m-d H:i:s').')', 'error');
            }

            return back();
        }
    }
}
