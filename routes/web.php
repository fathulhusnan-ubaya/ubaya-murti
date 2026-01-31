<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'permission-check']], function () {
    Route::view('/', 'admin.dashboard')->name('dashboard')->withoutMiddleware('permission-check');

    Route::view('user/profile', 'admin.user.profile')->name('admin.user.profile')->withoutMiddleware('permission-check');
    Route::view('user/password', 'admin.user.password')->name('admin.user.password')->withoutMiddleware('permission-check');
});
