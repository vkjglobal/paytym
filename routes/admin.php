<?php

use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EmployerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Confirm Password
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


Route::middleware('admin.auth')->group(function () {

        // Profile
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile', [ProfileController::class, 'store']);
    
        Route::post('update-password', [ProfileController::class, 'updatePass'])->name('update.password');


    // Employers
    Route::get('employer-change-status', [EmployerController::class, 'changeStatus'])->name('employer.change.status');
    Route::resource('employers', EmployerController::class)->except(['show']);

    // Contacts
    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    Route::post('contact', [ContactController::class, 'sendReply']);
    Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
});
