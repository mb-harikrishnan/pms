<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminAuth\Http\Controllers\AdminAuthController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('adminauths', AdminAuthController::class)->names('adminauth');
});
