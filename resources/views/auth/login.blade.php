@extends('layouts.auth', [
    'judul' => "Login"
])

@section('content')
    <p class="mw-80 m-t-5 mb-5">Masuk ke Akun Anda</p>
    <x-form id="form-login" method="post" action="login" submit="Login" submitIcon="fa-arrow-right-to-bracket">
        <x-input label="Username" id="input-username" name="username" class="mb-3" type="text" placeholder="Username" required />
        <x-input label="Password" id="input-password" name="password" class="mb-3" type="password" placeholder="Password" required />
    </x-form>
@endsection
