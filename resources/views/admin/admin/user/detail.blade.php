@php
    $judul = 'Tambah User';
    if (isset($user)) $judul = 'Detail User';
@endphp

@extends('layouts.admin', [
    'judul' => $judul,
    'breadcrumbs' => [
        [
            'url' => '#',
            'title' => "Administrator",
        ],
        [
            'url' => route('admin.user.index'),
            'title' => "User",
        ],
    ]
])

@section('contents')
    <div class="row">
        <div class="col-md-6">
            <x-card :header="$judul">
                <x-form :method="empty($user) ? 'POST' : 'PUT'" :action="empty($user) ? route('admin.user.store') : route('admin.user.update', $user)" submit="Simpan">
                    <x-input label="Username" id="input-username" name="username" :value="$user->Username ?? ''" class="mb-3" readonly="{{empty($user)?'0':'1'}}" required/>
                    <x-input label="Email" id="input-email" name="email" :value="$user->Email ?? ''" class="mb-3" readonly="{{empty($user)?'0':'1'}}" required/>
                    <x-input label="Nama" id="input-nama" name="nama" :value="$user->Nama ?? ''" class="mb-3" required/>
                    <x-input label="Password" id="input-password" name="password" class="mb-3" value="" type="password" required="{{empty($user)?'1':'0'}}" />
                    @php
                        $idRole = [];
                        foreach($user->Role ?? [] as $role) {
                            $idRole[] = $role->IdRole;
                        }
                    @endphp
                    <x-select label="Role" name="Role[]" id="role" :value="$idRole" :options="$daftarRole" class="mb-3" required multiple />
                </x-form>
            </x-card>
        </div>
    </div>
@endsection
