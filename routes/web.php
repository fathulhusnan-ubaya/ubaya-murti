<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'permission-check']], function () {
    Route::view('/', 'admin.dashboard')->name('dashboard')->withoutMiddleware('permission-check');

    Route::view('user/profile', 'admin.user.profile')->name('user.profile')->withoutMiddleware('permission-check');
    Route::view('user/password', 'admin.user.password')->name('user.password')->withoutMiddleware('permission-check');
});
