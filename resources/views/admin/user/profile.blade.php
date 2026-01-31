<?php $judul = 'Profil'; ?>
@extends('layouts.admin', ['judul' => $judul])

@section('contents')   
    <div class="row">
        <div class="col-md-6">
            <x-card :header="$judul">
                <x-form method="PUT" :action="route('user-profile-information.update')" submit="Simpan">
                    <x-input label="Username" id="username" name="username" class="mb-3" value="{{ auth()->user()->Username }}" required disabled/>
                    <x-input label="Nama" id="name" name="name" class="mb-3" value="{{ auth()->user()->Nama }}" required/>
                    <x-input label="Email" type="email" id="email" name="email" class="mb-3" value="{{ auth()->user()->Email }}" required/>
                </x-form>
            </x-card>
        </div>
    </div>
@endsection