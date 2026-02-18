<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminAuth\app\Http\Controllers\AdminAuthController;

Route::resource('adminauths', AdminAuthController::class)->names('adminauth');

Route::get('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login_check', [AdminAuthController::class, 'login_check'])
    ->name('admin.login_check');


Route::get('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');



