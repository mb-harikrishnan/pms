<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Http\Controllers\StaffController;

// Route::middleware(['nocache', 'nocache'])->group(function () {
Route::middleware(['admin.auth','prevent-back-history'])->group(function () {      

Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])
    ->name('staff.dashboard');

Route::get('/staff/header', [StaffController::class, 'header'])
    ->name('staff.header');

Route::get('/staff/add_employee', [StaffController::class, 'add_employee'])
    ->name('staff.add_employee');

    
Route::post('/staff/save_employee', [StaffController::class, 'save_employee'])
    ->name('staff.save_employee');

Route::get('/staff/employee_list', [StaffController::class, 'employee_list'])
    ->name('staff.employee_list');

 });

//   });