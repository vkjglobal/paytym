<?php

use App\Http\Controllers\Employer\Auth\ForgotPasswordController;
use App\Http\Controllers\Employer\Auth\LoginController;
use App\Http\Controllers\Employer\Auth\RegisterController;
use App\Http\Controllers\Employer\Auth\ResetPasswordController;
use App\Http\Controllers\Employer\HomeController;
use App\Http\Controllers\Employer\LeaveRequestController;
use App\Http\Controllers\Employer\PaymentRequestController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Reset Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Confirm Password
// Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::middleware('employer.auth')->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Leave Requests
    Route::get('leave-requests', [LeaveRequestController::class, 'index'])->name('leave.requests');
    Route::get('payment-requests', [PaymentRequestController::class, 'index'])->name('payment.requests');
});
