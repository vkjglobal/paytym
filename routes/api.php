<?php

use App\Http\Controllers\Api\Employee\AuthController;
use App\Http\Controllers\Api\Employee\ChatController;
use App\Http\Controllers\Api\Employee\LeaveRequestController;
use App\Http\Controllers\Employer\PaymentRequestController;
use App\Http\Middleware\CheckStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'index']);

// Forgot Password
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest');

Route::middleware(['auth:sanctum'])->group(function () {
    // Authentication
    Route::post('send-otp', [AuthController::class, 'sendOtp']);
    Route::post('confirm-otp', [AuthController::class, 'confirmOtp']);
    Route::post('password-update', [AuthController::class, 'updatePassword']);
    Route::post('password-reset', [AuthController::class, 'resetPassword']);
    Route::post('logout', [AuthController::class, 'logout']);


    // Leave Request
    Route::get('leave-request', [LeaveRequestController::class, 'index']);
    Route::post('leave-request', [LeaveRequestController::class, 'store']);

    // Payment Request
    Route::post('request-payment', [PaymentRequestController::class, 'index']);

    // Chats
    Route::get('get-chat', [ChatController::class, 'index']);
    Route::post('send-chat', [ChatController::class, 'store']);
});
