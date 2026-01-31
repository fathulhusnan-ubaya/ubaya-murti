<?php $judul = 'Ubah Password'; ?>
@extends('layouts.admin', ['judul' => $judul])

@section('contents')   
    <div class="row">
        <div class="col-md-6">
            <x-card :header="$judul">
                <x-form method="PUT" :action="route('user-password.update')" submit="Simpan">
                    <x-input label="Password Lama" type="password" id="current-password" name="current_password" class="mb-3" required placeholder="Masukkan Password Lama"/>
                    <x-input label="Password Baru" type="password" id="password" name="password" class="mb-3" required placeholder="Masukkan Password Baru"/>
                    <x-input label="Konfirmasi Password Baru" type="password" id="password-confirm" name="password_confirmation" class="mb-3" required placeholder="Masukkan Konfirmasi Password Baru"/>
                </x-form>
            </x-card>
        </div>
    </div>
@endsection