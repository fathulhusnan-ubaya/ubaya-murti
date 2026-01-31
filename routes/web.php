<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'permission-check']], function () {
    Route::view('/', 'admin.dashboard')->name('dashboard')->withoutMiddleware('permission-check');

    Route::group(['prefix' => 'select2', 'as' => 'select2.'], function () {
        // Route::get('menu', [MenuController::class, 'search'])->name('menu')->withoutMiddleware('permission-check');
        // Route::get('menu/select', [MenuController::class, 'select'])->name('menu.select')->withoutMiddleware('permission-check');
    });

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::resource('menu', MenuController::class)->except(['show']);
        Route::get('menu/urutan/{IdMenu}', [MenuController::class, 'getUrutan'])->name('menu.urutan');
        Route::resource('role', RoleController::class)->except(['show']);
        Route::resource('user', UserController::class)->except(['show']);
    });

    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
        Route::view('profile', 'admin.user.profile')->name('profile')->withoutMiddleware('permission-check');
        Route::view('password', 'admin.user.password')->name('password')->withoutMiddleware('permission-check');
    });
});
