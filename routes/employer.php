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
use App\Http\Controllers\Employer\AssignEmployerController;
use App\Http\Controllers\Employer\PayrollController;
use App\Http\Controllers\Employer\UserController;
use App\Http\Controllers\Employer\ProjectController;
use App\Http\Controllers\Employer\RosterController;
use App\Http\Controllers\Employer\UploadController;
use App\Http\Controllers\Employer\AttendanceController;
use App\Http\Controllers\Employer\BusinessController;
use App\Http\Controllers\Employer\AllowanceController;
use App\Http\Controllers\Employer\LeaveTypeController;
use App\Http\Controllers\Employer\FileTypeController;
use App\Http\Controllers\Employer\BenefitController;
use App\Http\Controllers\Employer\BillingController;
use App\Http\Controllers\Employer\CheckInOutTime;
use App\Http\Controllers\Employer\SupportTicketController;
use App\Http\Controllers\Employer\UserCapabilitiesController;
use App\Http\Controllers\Employer\PayslipController;
use App\Http\Controllers\Employer\PayrollSettingsController;
use App\Http\Controllers\Employer\ReportController;
use App\Http\Controllers\Employer\GroupChatController;
use App\Http\Controllers\Employer\EventController;
use App\Http\Controllers\Employer\HolidayController;
use App\Http\Controllers\Employer\MedicalController;
use App\Http\Controllers\Employer\PayrollBudgetController;
use App\Http\Controllers\Employer\SplitPaymentController;
use App\Http\Controllers\Employer\UserRoleController;
use App\Http\Controllers\Employer\AssignBenefitController;
use App\Http\Controllers\Employer\InvoiceController;
use App\Http\Controllers\Employer\MeetingController;
use App\Models\Employer;
use App\Models\PayrollBudget;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
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
    Route::get('leave-requests/create', [LeaveRequestController::class, 'create'])->name('leave.requests.create');
    Route::post('leave-requests/store', [LeaveRequestController::class, 'store'])->name('leave.requests.store');
    Route::delete('leave-requests/{id}', [LeaveRequestController::class, 'destroy'])->name('leave.requests.delete');
    Route::get('leave-requests/status/{id}', [LeaveRequestController::class, 'statusChange'])->name('leave.requests.status');
    Route::post('leave-requests/message/{id}', [LeaveRequestController::class, 'message'])->name('leave.requests.message');

    //Leave type
    Route::resource('leave-type', LeaveTypeController::class)->except(['show']);


    //Employee Medical Information
    Route::resource('medical', MedicalController::class);
    Route::get('medical/add/{id}', [MedicalController::class, 'add'])->name('medical.add');
    Route::get('payroll/export', [PayrollController::class, 'export'])->name('payroll.export');

    
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
    Route::post('user-shareinfo',[UserController::class,'SendMailWithPublicInfo'])->name('user.user-shareinfo');
    
    
    //Events
    Route::resource('event', EventController::class)->except(['show']);
    Route::get('event-change-status', [EventController::class, 'changeStatus'])->name('event.change.status');
   
    //Benefits
    Route::resource('benefit', BenefitController::class)->except(['show']);
    Route::get('benefit-change-status', [BenefitController::class, 'changeStatus'])->name('benefit.change.status');
    Route::resource('benefit/assignbenefit',AssignBenefitController::class)->except(['show']);
    
    //Support Tickets
    Route::resource('supportticket', SupportTicketController::class)->except(['show']);
    Route::get('supportticket-change-status', [SupportTicketController::class, 'changeStatus'])->name('supportticket.change.status');
    
  //User Roles
  Route::resource('userroles', UserRoleController::class)->except(['show']);
  //Route::put('usercapabilities/{id}',[UserCapabilitiesController::class,'update'])->name('usercapabilities.update');
  


    //User Capabilities
    Route::resource('usercapabilities', UserCapabilitiesController::class)->except(['show']);
    //Route::put('usercapabilities/{id}',[UserCapabilitiesController::class,'update'])->name('usercapabilities.update');
    
    
    
    //Projects
    Route::resource('project',ProjectController::class)->except(['show']);
    Route::get('project-change-status', [ProjectController::class, 'changeStatus'])->name('project.change.status');
    Route::resource('project/assign',AssignEmployerController::class)->except(['show']);
    Route::get('project/assign/search',[AssignEmployerController::class,'search'])->name('project.assign.search'); //project assign

    //Rosters
    Route::resource('roster',RosterController::class)->except(['show']);
    Route::get('roster/filter',[RosterController::class,'roster_filter'])->name('roster.filter');
    Route::get('roster/report',[RosterController::class,'roster_report'])->name('roster.report');

    //Deductions
    Route::resource('deduction',DeductionController::class)->except(['show']);
    Route::resource('deduction/assigndeduction',AssignDeductionController::class)->except(['show']);

    //Allowance
    Route::resource('allowance',AllowanceController::class)->except(['show']);

    Route::resource('allowance/assignallowance',AssignAllowanceController::class)->except(['show']);


    //Payroll
    Route::resource('payroll', PayrollController::class);
    Route::get('payroll-generate-form', [PayrollController::class,'generate_form'])->name('payroll.generate.form');
    Route::post('payroll-generate-hourly', [PayrollController::class,'generate_hourly_payroll'])->name('payroll.generate.hourly');
    
    //Uploads
    Route::resource('uploads', UploadController::class);
    Route::get('upload/download/{id}', [UploadController::class,'download'])->name('upload.download');
    Route::get('upload/createform/{id}', [UploadController::class,'showCreateForm'])->name('upload.form');
    Route::resource('file_type', FileTypeController::class);
  

    //Attendance
    Route::resource('attendance', AttendanceController::class);
    Route::post('attendance/csvfile', [AttendanceController::class, 'csvfile'])->name('attendance.csvfile');

    //Business
    Route::resource('business', BusinessController::class)->except(['show']);
    Route::get('business-change-status', [BusinessController::class, 'changeStatus'])->name('business.change.status');

    //Holiday
    Route::resource('holiday', HolidayController::class)->except(['show']);
    //chat
    // Route::resource('chat', ChatController::class);
    Route::resource('groupchat', GroupChatController::class);
    Route::resource('groupmember', GroupMembersAddController::class);


    //bonus
    Route::resource('bonus', BonusController::class);

    //commission
    Route::resource('commission', CommissionController::class);

    //ProvidentFund
    Route::resource('providentfund', ProvidentFundController::class);

    //payslip
    Route::get('payslip/show', [PayslipController::class,'index'])->name('payslip.show');
    Route::get('payslip/create/{id}', [PayslipController::class,'create'])->name('payslip.create');
    Route::get('payslip/view/default', [PayslipController::class,'view_payslip'])->name('payslip.view.default');
    Route::post('payslip/store', [PayslipController::class,'store'])->name('payslip.store');

    //Report
    Route::get('report/attendance',[ReportController::class,'attendance_index'])->name('report.attendance.search');
    Route::post('report/attendance/filter',[ReportController::class,'attendance_filter'])->name('report.attendance.filter');
    Route::get('report/attendance/export',[ReportController::class,'attendance_filter_export'])->name('report.attendance.export');

    Route::get('report/employment_period',[ReportController::class,'employment_period_index'])->name('report.employment_period');
    Route::get('report/employment_period/filter',[ReportController::class,'employee_period_filter'])->name('report.employment_period.filter');
    Route::get('report/employment_period/export',[ReportController::class,'employment_period_export'])->name('report.employment_period.export');
    /////Ajax get
    Route::get('report/employment_period/get_branch/{id}',[ReportController::class,'employee_period_get_branch'])->name('report.employment_period.get_branch');
    Route::get('report/employment_period/get_department/{id}',[ReportController::class,'employee_period_get_department'])->name('report.employment_period.get_department');
    Route::get('report/employment_period/get_user/{id}',[ReportController::class,'employee_period_get_user'])->name('report.employment_period.get_user');
    /////////////
    Route::get('report/employee',[ReportController::class,'employee_list_index'])->name('report.employee');
    Route::get('report/employee/filter',[ReportController::class,'employee_list_filter'])->name('report.employee.filter');
    Route::get('report/employee/export',[ReportController::class,'employee_list_export'])->name('report.employee.export');


    // Route::get('report/status',[ReportController::class,'status_list_index'])->name('report.status');

    Route::get('report/status/business',[ReportController::class,'status_business'])->name('report.status.business');
    Route::get('report/status/business/export',[ReportController::class,'status_business_export'])->name('report.status.business.export');
    Route::get('report/status/business/export/print',[ReportController::class,'status_business_export_print'])->name('report.status.business.export.print');

    Route::get('report/status/branch',[ReportController::class,'status_branch'])->name('report.status.branch');
    Route::get('report/status/branch/export',[ReportController::class,'status_branch_export'])->name('report.status.branch.export');
    
    Route::get('report/status/department',[ReportController::class,'status_department'])->name('report.status.department');
    Route::get('report/status/department/export',[ReportController::class,'status_department_export'])->name('report.status.department.export');

    Route::get('report/status/project',[ReportController::class,'status_project'])->name('report.status.project');
    Route::get('report/status/project/export',[ReportController::class,'status_project_export'])->name('report.status.project.export');

    Route::get('report/allowance',[ReportController::class,'allowane_index'])->name('report.allowance');
    Route::get('report/allowance/view/{id}',[ReportController::class,'allowance_view'])->name('report.allowance.view');
    Route::get('report/allowance/export',[ReportController::class,'allowance_export'])->name('report.allowance.export');

    Route::get('report/deduction',[ReportController::class,'deduction_index'])->name('report.deduction');
    Route::get('report/deduction/view/{id}',[ReportController::class,'deduction_view'])->name('report.deduction.view');
    Route::get('report/deduction/export',[ReportController::class,'deduction_export'])->name('report.deduction.export');

    Route::get('report/payroll',[ReportController::class,'payroll_index'])->name('report.payroll');
    Route::get('report/payroll/export',[ReportController::class,'payroll_export'])->name('report.payroll.export');

    Route::get('report/providentfund',[ReportController::class,'providentfund_index'])->name('report.providentfund');
    Route::get('report/providentfund/filter',[ReportController::class,'providentfund_filter'])->name('report.providentfund.filter');
    Route::get('report/providentfund/export',[ReportController::class,'providentfund_export'])->name('report.providentfund.export');

    Route::get('report/tax',[ReportController::class,'tax_index'])->name('report.tax');
    Route::get('report/tax/filter',[ReportController::class,'tax_filter'])->name('report.tax.filter');
    Route::get('report/tax/export',[ReportController::class,'tax_export'])->name('report.tax.export');

    Route::get('report/payslip',[ReportController::class,'payslip_index'])->name('report.payslip');
    Route::post('report/payslip/payslip_send_mail',[ReportController::class,'payslip_send_mail'])->name('report.payslip.send.mail');
    Route::get('report/payslip/export',[ReportController::class,'payslip_export'])->name('report.payslip.export');

    Route::get('report/status',[ReportController::class,'status_index'])->name('report.status');
    Route::get('report/status/export',[ReportController::class,'status_export'])->name('report.status.export');
    
    Route::get('report/budget',[ReportController::class,'budget_index'])->name('report.budget');
    Route::get('report/budget/export',[ReportController::class,'budget_export'])->name('report.budget.export');
    Route::get('report/projectreport',[ReportController::class,'projectreport_index'])->name('report.projectreport');
    Route::get('report/projectreport/export',[ReportController::class,'projectreport_export'])->name('report.projectreport.export');
    //Billing
    Route::post('/billing', [BillingController::class,'index'])->name('billing');
    Route::post('/billing/pay', [BillingController::class,'pay'])->name('billing.pay');
    Route::get('/billing/plan', [BillingController::class,'plan'])->name('billing.plan');
    Route::get('/billing/invoice', [BillingController::class,'invoice'])->name('billing.invoice');

    //Payroll settings 
    Route::get('payroll-setting-hourly',[PayrollSettingsController::class,'index'])->name('payroll-setting-hourly.index');
    Route::get('payroll-setting-hourly/create/{id}',[PayrollSettingsController::class,'create'])->name('payroll-setting-hourly.create');
    Route::post('payroll-setting-hourly/store', [PayrollSettingsController::class,'store'])->name('payroll-setting-hourly.store');


    // checkin checkout time
    Route::get('check-in-out-time',[CheckInOutTime::class,'index'])->name('checkinout');
    Route::post('check-in-out-time/update/{id}',[CheckInOutTime::class,'update'])->name('checkinout.update');

    //payroll budget
    Route::resource('payroll-budget', PayrollBudgetController::class);


    //splitpayment
    Route::get('split_payment',[SplitPaymentController::class,'index'])->name('split_payment.wallet');

    //invoice
        Route::resource('invoice', InvoiceController::class);
    //Route::get('split_payment',[SplitPaymentController::class,'index'])->name('split_payment.wallet');

    //Route::get('/view_invoice/{id}', 'InvoiceController@index')->name('example');



    Route::get('view_invoice/{id}',[InvoiceController::class,'view_invoice'])->name('view_invoice');

    //Meetings
    Route::resource('meeting', MeetingController::class)->except(['show']);
    Route::get('meeting/view/{id}', [MeetingController::class, 'view_details'])->name('meeting.details');
  });

