<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Gate::define('accessable', function () {
            $role = session('my')->RoleAktif;
            if ($role->Nama == 'Administrator') {
                return true;
            }

            $routeName = request()->route()->action['as'];
            $routes = explode('.', $routeName);
            $indexRoute = '';

            for ($i = 0; $i < count($routes) - 1; $i++) {
                $indexRoute .= $routes[$i].'.';
            }
            $indexRoute .= 'index';

            return $role->getLevelPermission($indexRoute) > 10;
        });
    }
}
