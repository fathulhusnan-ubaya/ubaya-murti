@php
    $judul = 'Tambah Contoh';
    if (isset($contoh)) $judul = 'Detail Contoh';
@endphp

@extends('layouts.admin', [
    'judul' => $judul,
    'breadcrumbs' => [
        [
            'url' => route('contoh.index'),
            'title' => "Contoh",
        ]
    ]
])

@section('contents')
    <div class="row">
        <div class="col-md-5">
            <x-card :header="$judul">
                <x-form :method="empty($contoh) ? 'POST' : 'PUT'" :action="empty($contoh) ? route('contoh.store') : route('contoh.update', $contoh)" submit="Simpan">
                    <x-input label="Nama" id="input-nama" name="nama" :value="$contoh->Nama ?? ''" class="mb-3" required/>
                </x-form>
            </x-card>
        </div>
    </div>
@endsection
