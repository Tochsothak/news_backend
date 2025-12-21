<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('verify', [AuthController::class, 'verify']);
    Route::post('resend', [AuthController::class, 'resend']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('request-reset-password', [AuthController::class, 'requestResetPassword']);
    Route::post('verify-reset-password', [AuthController::class, 'verifyResetPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});
