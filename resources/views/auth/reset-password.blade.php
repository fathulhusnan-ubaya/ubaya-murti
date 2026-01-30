@extends('layouts.auth', ['judul' => 'Reset Password'])

@section('content')
    <p class="mw-80 m-t-5 mb-5">Reset Password</p>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    
    <x-form id="form-reset-password" method="POST" action="{{route('password.update')}}" submit="Reset" submitIcon="fa-arrow-right-to-bracket">
    @csrf
            <input type="hidden" name="token" value="{{ request()->token  }}">

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $request->email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Alamat Elamil">
                @error('email')
                <div class="alert alert-danger mt-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Masukkan Password Baru">
                @error('password')
                <div class="alert alert-danger mt-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Konfirmasi Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="new-password" placeholder="Masukkan Konfirmasi Password Baru">
            </div>
    </x-form>
@endsection