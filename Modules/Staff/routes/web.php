<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Http\Controllers\StaffController;
use Modules\Staff\Http\Controllers\ProjectController;

// Route::middleware(['nocache', 'nocache'])->group(function () {
Route::middleware(['admin.auth','prevent-back-history'])->group(function () {     
    
///////////////////////////   DASHBOARD  ///////////////////////////////////

Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])
    ->name('staff.dashboard');


///////////////////////////  HEADER ////////////////////////////////////////

Route::get('/staff/header', [StaffController::class, 'header'])
    ->name('staff.header');



//////////////////////////  EMPLOYEEE MANAGMENT  //////////////////////////////    

Route::get('/staff/add_employee', [StaffController::class, 'add_employee'])
    ->name('staff.add_employee');

    
Route::post('/staff/save_employee', [StaffController::class, 'save_employee'])
    ->name('staff.save_employee');

Route::get('/staff/employee_list', [StaffController::class, 'employee_list'])
    ->name('staff.employee_list');


Route::get('/staff/delete_employee_id/{id}', [StaffController::class, 'delete_employee_id'])
    ->name('staff.delete_employee_id');


    Route::get('/staff/edit_employee/{id}', [StaffController::class, 'edit_employee'])
    ->name('staff.edit_employee');


Route::post('/staff/update_employee/{id}',  [StaffController::class, 'update_employee'])
    ->name('staff.update_employee');


 //////////////////////   DEPARTMENT MANAGMENT   ///////////////////////////////



Route::get('/staff/add_department', [StaffController::class, 'add_department'])
    ->name('staff.add_department');

    
Route::post('/staff/save_department', [StaffController::class, 'save_department'])
    ->name('staff.save_department');

Route::get('/staff/department_list', [StaffController::class, 'department_list'])
    ->name('staff.department_list');

Route::match(['get', 'post'], '/staff/delete_employee/{id}', [StaffController::class, 'delete_employee'])
    ->name('staff.delete_employee');


Route::get('/staff/get_roles', [StaffController::class, 'get_roles'])->name('staff.get_roles');



/////////////////////////////  PROJECT MANAGMENT  ////////////////////////////////////////////



Route::get('/staff/add_projects', [ProjectController::class, 'add_projects'])
    ->name('staff.add_projects');


    Route::post('/staff/save_project', [ProjectController::class, 'save_project'])
    ->name('staff.save_project');

    
    Route::get('/staff/get_project_parent', [ProjectController::class, 'get_project_parent'])
    ->name('staff.get_project_parent');


    Route::get('/staff/project_list', [ProjectController::class, 'project_list'])
    ->name('staff.project_list');

    
























 });
