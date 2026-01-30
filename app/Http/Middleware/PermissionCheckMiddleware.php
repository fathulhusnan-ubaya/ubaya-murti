<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = Route::getCurrentRoute()->action['as'] ?? throw new \Exception('Please define route name in route file');

        $menu = Menu::where('RouteName', $routeName)->pluck('RouteName')->first();

        if (empty($menu)) {
            $routeName = explode('.', $routeName);
            array_pop($routeName);
            $routeName = implode('.', $routeName) . '.index';

            $menu = Menu::where('RouteName', $routeName)->pluck('RouteName')->first();
        }

        abort_if(empty($menu), 404, 'Menu tidak terdaftar');

        if (!session('my')->RoleAktif->getLevelPermission($menu)) {
            abort_if(!app()->isProduction(), 403, 'Hak akses belum disetting!');
            abort(404, 'Hak akses tidak ditemukan');
        }

        return $next($request);
    }
}
