<?php

use App\Http\Controllers\ContohController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Select2Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'permission-check']], function () {
    Route::view('/', 'admin.dashboard')->name('dashboard')->withoutMiddleware('permission-check');

    Route::group(['prefix' => 'select2', 'as' => 'select2.'], function () {
        Route::get('role', [Select2Controller::class, 'role'])->name('role')->withoutMiddleware('permission-check');
        Route::get('menu', [Select2Controller::class, 'menu'])->name('menu')->withoutMiddleware('permission-check');
    });

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::resource('menu', MenuController::class)->except(['show']);
        Route::get('menu/urutan/{IdMenu}', [MenuController::class, 'getUrutan'])->name('menu.urutan');
        Route::resource('role', RoleController::class)->except(['create', 'show', 'edit']);
        Route::resource('privilege', PrivilegeController::class)->except(['show', 'edit', 'update', 'destroy']);
        Route::delete('privilege/{role}/{menu}', [PrivilegeController::class, 'destroy'])->name('privilege.destroy');
        Route::resource('user', UserController::class)->except(['show', 'create', 'post']);
    });

    // Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
    //     Route::view('profile', 'admin.user.profile')->name('profile')->withoutMiddleware('permission-check');
    //     Route::view('password', 'admin.user.password')->name('password')->withoutMiddleware('permission-check');
    // });

    // Route::resource('contoh', ContohController::class)->except(['show']);
});
