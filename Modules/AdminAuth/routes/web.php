<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminAuth\Http\Controllers\AdminAuthController;
use Modules\AdminAuth\Http\Controllers\ChangePasswordController;

Route::resource('adminauths', AdminAuthController::class)->names('adminauth');

Route::get('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login_check', [AdminAuthController::class, 'login_check'])
    ->name('admin.login_check');


Route::get('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


Route::get('/change-password', [ChangePasswordController::class, 'index'])
    ->name('admin.change.password');

Route::post('/change-password', [ChangePasswordController::class, 'update'])
    ->name('admin.save_password');

Route::get('/check-old-password', [ChangePasswordController::class, 'checkOldPassword'])
    ->name('admin.check.old.password');


