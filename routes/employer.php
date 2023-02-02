<?php

use App\Http\Controllers\Employer\Auth\ForgotPasswordController;
use App\Http\Controllers\Employer\Auth\LoginController;
use App\Http\Controllers\Employer\Auth\RegisterController;
use App\Http\Controllers\Employer\Auth\ResetPasswordController;
use App\Http\Controllers\Employer\HomeController;
use App\Http\Controllers\Employer\LeaveRequestController;
use App\Http\Controllers\Employer\PaymentRequestController;   
use App\Http\Controllers\Employer\ProfileController;
use App\Http\Controllers\Employer\BranchController;
use App\Http\Controllers\Employer\DepartmentController;
use App\Http\Controllers\Employer\PayrollController;
use App\Http\Controllers\Employer\UserController;
use App\Http\Controllers\Employer\ProjectController;
use App\Http\Controllers\Employer\RosterController;
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

      // Profile
      Route::get('profile', [ProfileController::class, 'index'])->name('profile');
      Route::post('profile', [ProfileController::class, 'store']);

      Route::post('update-password', [ProfileController::class, 'updatePass'])->name('update.password');

    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Leave Requests
    Route::get('leave-requests', [LeaveRequestController::class, 'index'])->name('leave.requests');
    Route::delete('leave-requests/{id}', [LeaveRequestController::class, 'destroy'])->name('leave.requests.delete');
    Route::get('leave-requests/status/{id}', [LeaveRequestController::class, 'statusChange'])->name('leave.requests.status');

    Route::get('payment-requests', [PaymentRequestController::class, 'index'])->name('payment.requests');


    // Branch
    Route::get('branch/create', [BranchController::class, 'index'])->name('branch.create');
    Route::get('branch/list', [BranchController::class, 'list'])->name('branch.list');
    Route::post('branch/store',[BranchController::class,'store'])->name('branch.store');
    Route::get('branch/{id}/edit',[BranchController::class,'edit'])->name('branch.edit');
    Route::put('branch/{id}',[BranchController::class,'update'])->name('branch.update');
    Route::get('branch-change-status', [BranchController::class, 'changeStatus'])->name('branch.change.status');  //change status
    Route::delete('branch/{id}',[BranchController::class, 'destroy'])->name('branch.destroy');

    // Departments
    Route::resource('department', DepartmentController::class)->except(['show']);
    Route::get('department-change-status', [DepartmentController::class, 'changeStatus'])->name('department.change.status');

    //Users
    Route::resource('user', UserController::class)->except(['show']);
    Route::get('user-change-status', [UserController::class, 'changeStatus'])->name('user.changestatus');
    
    //Events
    Route::resource('event', EventController::class)->except(['show']);
   

    //Projects
    Route::resource('project',ProjectController::class)->except(['show']);

  
    



});
