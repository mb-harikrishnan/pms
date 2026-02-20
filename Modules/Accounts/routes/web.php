<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounts\Http\Controllers\AccountsController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('accounts', AccountsController::class)->names('accounts');
// });


Route::get('/accounts/request_form', [AccountsController::class, 'request_form'])
    ->name('accounts.request_form');

Route::post('/accounts/save_request', [AccountsController::class, 'save_request'])
    ->name('accounts.save_request');

Route::get('/accounts/request_list', [AccountsController::class, 'request_list'])
    ->name('accounts.request_list');

Route::match(['get','post'], '/accounts/approve_request/{id}', [AccountsController::class, 'approve_request']
)->name('accounts.approve_request');

Route::match(['get','post'], '/accounts/reject_request/{id}', [AccountsController::class, 'reject_request']
)->name('accounts.reject_request');

Route::match(['get','post'], '/accounts/approve_request_admin/{id}', [AccountsController::class, 'approve_request_admin']
)->name('accounts.approve_request_admin');

Route::match(['get','post'], '/accounts/reject_request_admin/{id}', [AccountsController::class, 'reject_request_admin']
)->name('accounts.reject_request_admin');



Route::get('/accounts/expence_form', [AccountsController::class, 'expence_form'])
    ->name('accounts.expence_form');

    Route::get('/accounts/expence_list', [AccountsController::class, 'expence_list'])
        ->name('accounts.expence_list');

Route::match(['get','post'], '/accounts/save_expence_request', [AccountsController::class, 'save_expence_request']
)->name('accounts.save_expence_request');



Route::match(['get','post'], '/accounts/approve_request_expence/{id}', [AccountsController::class, 'approve_request_expence']
)->name('accounts.approve_request_expence');

Route::match(['get','post'], '/accounts/reject_request_expence/{id}', [AccountsController::class, 'reject_request_expence']
)->name('accounts.reject_request_expence');


    

Route::get('/accounts/wallet_request_form', [AccountsController::class, 'wallet_request_form'])
    ->name('accounts.wallet_request_form');

Route::get('/accounts/wallet_request_list', [AccountsController::class, 'wallet_request_list'])
    ->name('accounts.wallet_request_list');

    Route::match(['get','post'], '/accounts/save_wallet_request', [AccountsController::class, 'save_wallet_request']
)->name('accounts.save_wallet_request');


Route::match(['get','post'], '/accounts/approve_wallet_request/{id}', [AccountsController::class, 'approve_wallet_request']
)->name('accounts.approve_wallet_request');
    
Route::match(['get','post'], '/accounts/reject_wallet_request/{id}', [AccountsController::class, 'reject_wallet_request']
)->name('accounts.reject_wallet_request');

Route::match(['get','post'], '/accounts/approve_wallet_request_admin/{id}', [AccountsController::class, 'approve_wallet_request_admin']
)->name('accounts.approve_wallet_request_admin');
    
Route::match(['get','post'], '/accounts/reject_wallet_request_admin/{id}', [AccountsController::class, 'reject_wallet_request_admin']
)->name('accounts.reject_wallet_request_admin');





