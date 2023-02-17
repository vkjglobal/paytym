<?php

use App\Http\Controllers\Api\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Api\Employee\AuthController;
use App\Http\Controllers\Api\Employee\ChatController;
use App\Http\Controllers\Api\Employee\LeaveRequestController;
use App\Http\Controllers\Api\Employee\AttendanceController;
use App\Http\Controllers\Api\Employee\DeductionsController;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Employee\MeetingsController;
use App\Http\Controllers\Api\Employee\PaymentAdvanceController;
use App\Http\Controllers\Employer\PaymentRequestController;
use App\Http\Controllers\Api\Employee\QuitCompanyController;
use App\Http\Controllers\Api\Employee\EventController;
use App\Http\Controllers\Api\Employee\LeaveController;
use App\Http\Middleware\CheckStatus;
use App\Models\PaymentRequest;
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

//forgotPwd_confirmOtp
Route::post('forgotpwd-confirm-otp', [AuthController::class, 'forgotPwd_confirmOtp']);
Route::post('forgotpwd-password-update', [AuthController::class, 'forgotPwd_updatePassword']);


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
    Route::post('dashboard', [LeaveRequestController::class, 'dashboard']);

    // Payment Request
    Route::post('request-payment', [PaymentRequestController::class, 'index']);

    //Pay Slips --Robin 17-11-22
    Route::post('payslip', [PaymentRequestController::class, 'payslip']);

    //Payment Advance 18-11-22
    Route::post('request_advance', [PaymentAdvanceController::class, 'request_advance']);

    // Attendance
    Route::post('check_in', [AttendanceController::class, 'check_in']);
    Route::post('check_out', [AttendanceController::class, 'check_out']);

    Route::post('check_in_by_scan', [AttendanceController::class, 'check_in_by_scan']);
    Route::post('check_out_by_scan', [AttendanceController::class, 'check_out_by_scan']);

    Route::post('attendance', [AttendanceController::class, 'attendance']);

    Route::get('attendance_list', [AttendanceController::class, 'attendance_list']);

    // Request Payment 19-11-22
    Route::post('request_payment', [PaymentRequestController::class, 'request_payment']);

    Route::post('deductions', [DeductionsController::class, 'deductions']);

    // Request Payment 21-11-22
    Route::post('meetings', [MeetingsController::class, 'meetings']);

    // End Robin 
    // Chats
    Route::get('get-chat', [ChatController::class, 'index']);
    Route::post('send-chat', [ChatController::class, 'store']);

    //Quit Company
    Route::post('quit_company', [QuitCompanyController::class, 'quit_request']);

    // Events



    // Robin 14-02-2023

    Route::post('chat_group', [ChatController::class, 'list_chat_groups']);
    Route::post('chat_group_detais', [ChatController::class, 'list_chat_group_details']);
    Route::post('get_holidays', [LeaveController::class, 'get_holidays']);

    Route::get('employee_dashboard', [EmployeeDashboardController::class, 'index']);

    // Robin 15-02-2023
    Route::post('checkin_checkout_list', [AttendanceController::class, 'check_in_check_out_list']);
    Route::post('leave_requests_lists', [LeaveRequestController::class, 'leave_requests_lists']);
    Route::post('leave_requests_accept_reject', [LeaveRequestController::class, 'leave_requests_accept_reject']);
    Route::post('create_leaves', [LeaveController::class, 'create_leaves']);
    Route::post('list_leaves', [LeaveController::class, 'list_leaves']);
    Route::post('delete_leave', [LeaveController::class, 'delete_leave']);
    Route::post('events_list', [EventController::class, 'list_events']);
    Route::post('create_event', [EventController::class, 'create_event']);
    Route::post('delete_event', [EventController::class, 'delete_event']);

    // Robin 16-02-2023

    Route::post('create_chat_groups', [ChatController::class, 'create_chat_groups']);
    Route::post('list_employees', [EmployeeController::class, 'list_employees']);
    Route::post('list_employees_departmentwise', [EmployeeController::class, 'list_employees_departmentwise']);
    Route::post('list_employees_branchwise', [EmployeeController::class, 'list_employees_branchwise']);
    Route::post('attendance_approve_reject', [AdminAttendanceController::class, 'attendance_approve_reject']);
    Route::post('attendance_edit', [AdminAttendanceController::class, 'attendance_edit']);

});
