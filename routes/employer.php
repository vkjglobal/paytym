<?php

use App\Http\Controllers\Api\Admin\MeetingsController;
use App\Http\Controllers\Api\Employee\PayrollCalculationController;
use App\Http\Controllers\Employer\AdvanceController;
use App\Http\Controllers\Employer\Auth\ForgotPasswordController;
use App\Http\Controllers\Employer\Auth\LoginController;
use App\Http\Controllers\Employer\Auth\RegisterController;
use App\Http\Controllers\Employer\Auth\ResetPasswordController;
use App\Http\Controllers\Employer\Auth\VerificationController;
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
use App\Http\Controllers\Employer\CardController;
use App\Http\Controllers\Employer\BillingEmailController;
use App\Http\Controllers\Employer\ProjectExpenseController;
use App\Http\Controllers\Employer\BSPPaymentController;
use App\Http\Controllers\Employer\FRCSController;
use App\Http\Controllers\Employer\MeetingsController as EmployerMeetingsController;
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


//Auth::routes(['verify' => true]);


// Reset Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Confirm Password
// Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
 Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
//Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
 Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::get('list_invoice/{id}', [InvoiceController::class, 'list_invoice'])->name('list_invoice');
Route::get('invoice_checkout/{id}', [InvoiceController::class, 'invoice_checkout'])->name('invoice_checkout');
//Route::middleware('employer.auth')->group(function () {
 
 
  Route::middleware(['employer.auth', 'check.employer.status','verified'])->group(function () {
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
  Route::post('branch/store', [BranchController::class, 'store'])->name('branch.store');
  Route::get('branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
  Route::put('branch/{id}', [BranchController::class, 'update'])->name('branch.update');
  Route::get('branch-change-status', [BranchController::class, 'changeStatus'])->name('branch.change.status');  //change status
  Route::delete('branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
  // Robin updated 30-08-23
  Route::get('view_branch_qrcode/{id}', [BranchController::class, 'view_branch_qrcode'])->name('branch.view_branch_qrcode');
  Route::get('generate_branch_qrcode/{id}', [BranchController::class, 'generate_branch_qrcode'])->name('branch.generate_branch_qrcode');



  // Departments
  Route::resource('department', DepartmentController::class)->except(['show']);
  Route::get('department-change-status', [DepartmentController::class, 'changeStatus'])->name('department.change.status');

  //Users
  Route::resource('user', UserController::class)->except(['show']);
  Route::get('user-change-status', [UserController::class, 'changeStatus'])->name('user.changestatus');
  Route::post('user-shareinfo', [UserController::class, 'SendMailWithPublicInfo'])->name('user.user-shareinfo');
  Route::get('user-import', [UserController::class, 'importEmployee'])->name('user.import');
  Route::post('user/csvfile', [UserController::class, 'csvfile'])->name('user.csvfile');
  Route::get('user/download-template-newemp', [UserController::class,'downloadTemplate_newEmployee'])->name('download.usertemplate_newemp');
  Route::get('user/download-template-existingemp', [UserController::class,'downloadTemplate_existingEmployee'])->name('download.usertemplate_existingemp');
  Route::get('user/download-instruction', [UserController::class,'downloadInstruction'])->name('download.instruction_doc');
  Route::get('user/download-exemp-instruction', [UserController::class,'downloadexEmpInstruction'])->name('download.exemp_instruction_doc');
  //19-10-13 Exisiting Employee & FRCS
  Route::get('existing-user-import', [UserController::class, 'importExistingEmployee'])->name('existing.user.import');
  Route::post('user/frcsimport', [UserController::class, 'frcsimport'])->name('user.frcsimport');
  
  Route::resource('frcs', FRCSController::class);
  Route::get('frcs/add/{id}', [FRCSController::class, 'add'])->name('frcs.add');
  //Events
  Route::resource('event', EventController::class)->except(['show']);
  Route::get('event-change-status', [EventController::class, 'changeStatus'])->name('event.change.status');

  //Benefits
  Route::resource('benefit', BenefitController::class)->except(['show']);
  Route::get('benefit-change-status', [BenefitController::class, 'changeStatus'])->name('benefit.change.status');
  Route::resource('benefit/assignbenefit', AssignBenefitController::class)->except(['show']);

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
  Route::resource('project', ProjectController::class)->except(['show']);
  Route::get('project-change-status', [ProjectController::class, 'changeStatus'])->name('project.change.status');
  Route::resource('project/assign', AssignEmployerController::class)->except(['show']);
  Route::get('project/assign/search', [AssignEmployerController::class, 'search'])->name('project.assign.search'); //project assign

//Project Expense
  Route::get('project-expense/{id}', [ProjectExpenseController::class, 'calculate_project_expense'])->name('calculate_project_expense');

  //Rosters
  Route::resource('roster', RosterController::class)->except(['show']);
  Route::get('roster/filter', [RosterController::class, 'roster_filter'])->name('roster.filter');
  Route::get('roster/report', [RosterController::class, 'roster_report'])->name('roster.report');

  //Deductions
  Route::resource('deduction', DeductionController::class)->except(['show']);
  Route::resource('deduction/assigndeduction', AssignDeductionController::class)->except(['show']);

  //Allowance
  Route::resource('allowance', AllowanceController::class)->except(['show']);

  Route::resource('allowance/assignallowance', AssignAllowanceController::class)->except(['show']);


  //Payroll
  Route::resource('payroll', PayrollController::class);
  Route::get('payroll-generate-form', [PayrollController::class, 'generate_form'])->name('payroll.generate.form');
  Route::post('payroll-generate-hourly', [PayrollController::class, 'generate_hourly_payroll'])->name('payroll.generate.hourly');

  //Uploads
  Route::resource('uploads', UploadController::class);
  Route::get('upload/download/{id}', [UploadController::class, 'download'])->name('upload.download');
  Route::get('upload/createform/{id}', [UploadController::class, 'showCreateForm'])->name('upload.form');
  Route::resource('file_type', FileTypeController::class);


  //Attendance
  Route::resource('attendance', AttendanceController::class);
  Route::post('attendance/csvfile', [AttendanceController::class, 'csvfile'])->name('attendance.csvfile');

  //Business
  Route::resource('business', BusinessController::class)->except(['show']);
  Route::get('business-change-status', [BusinessController::class, 'changeStatus'])->name('business.change.status');
  Route::get('view_qrcode/{id}', [BusinessController::class, 'view_qrcode'])->name('business.view_qrcode');
  Route::get('generate_qrcode/{id}', [BusinessController::class, 'generate_qrcode'])->name('business.generate_qrcode');


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
  Route::get('payslip/show', [PayslipController::class, 'index'])->name('payslip.show');
  Route::get('payslip/create/{id}', [PayslipController::class, 'create'])->name('payslip.create');
  Route::get('payslip/view/default', [PayslipController::class, 'view_payslip'])->name('payslip.view.default');
  Route::post('payslip/store', [PayslipController::class, 'store'])->name('payslip.store');

  //Report
  Route::get('report/attendance', [ReportController::class, 'attendance_index'])->name('report.attendance.search');
  Route::post('report/attendance/filter', [ReportController::class, 'attendance_filter'])->name('report.attendance.filter');
  Route::get('report/attendance/export', [ReportController::class, 'attendance_filter_export'])->name('report.attendance.export');

  Route::get('report/employment_period', [ReportController::class, 'employment_period_index'])->name('report.employment_period');
  Route::get('report/employment_period/filter', [ReportController::class, 'employee_period_filter'])->name('report.employment_period.filter');
  Route::get('report/employment_period/export', [ReportController::class, 'employment_period_export'])->name('report.employment_period.export');
  /////Ajax get
  Route::get('report/employment_period/get_branch/{id}', [ReportController::class, 'employee_period_get_branch'])->name('report.employment_period.get_branch');
  Route::get('report/employment_period/get_department/{id}', [ReportController::class, 'employee_period_get_department'])->name('report.employment_period.get_department');
  Route::get('report/employment_period/get_user/{id}', [ReportController::class, 'employee_period_get_user'])->name('report.employment_period.get_user');

  Route::get('report/employment_period/get_bank/{id}', [ReportController::class, 'employee_period_get_bank'])->name('report.employment_period.get_bank');
  /////////////
  Route::get('report/employee', [ReportController::class, 'employee_list_index'])->name('report.employee');
  Route::get('report/employee/filter', [ReportController::class, 'employee_list_filter'])->name('report.employee.filter');
  Route::get('report/employee/export', [ReportController::class, 'employee_list_export'])->name('report.employee.export');


  // Route::get('report/status',[ReportController::class,'status_list_index'])->name('report.status');

  Route::get('report/status/business', [ReportController::class, 'status_business'])->name('report.status.business');
  Route::get('report/status/business/export', [ReportController::class, 'status_business_export'])->name('report.status.business.export');
  Route::get('report/status/business/export/print', [ReportController::class, 'status_business_export_print'])->name('report.status.business.export.print');

  Route::get('report/status/branch', [ReportController::class, 'status_branch'])->name('report.status.branch');
  Route::get('report/status/branch/export', [ReportController::class, 'status_branch_export'])->name('report.status.branch.export');

  Route::get('report/status/department', [ReportController::class, 'status_department'])->name('report.status.department');
  Route::get('report/status/department/export', [ReportController::class, 'status_department_export'])->name('report.status.department.export');

  Route::get('report/status/project', [ReportController::class, 'status_project'])->name('report.status.project');
  Route::get('report/status/project/export', [ReportController::class, 'status_project_export'])->name('report.status.project.export');

  Route::get('report/allowance', [ReportController::class, 'allowane_index'])->name('report.allowance');
  Route::get('report/allowance/view/{id}', [ReportController::class, 'allowance_view'])->name('report.allowance.view');
  Route::get('report/allowance/export', [ReportController::class, 'allowance_export'])->name('report.allowance.export');

  Route::get('report/deduction', [ReportController::class, 'deduction_index'])->name('report.deduction');
  Route::get('report/deduction/view/{id}', [ReportController::class, 'deduction_view'])->name('report.deduction.view');
  Route::get('report/deduction/export', [ReportController::class, 'deduction_export'])->name('report.deduction.export');

  Route::get('report/payroll', [ReportController::class, 'payroll_index'])->name('report.payroll');
  Route::get('report/payroll/export', [ReportController::class, 'payroll_export'])->name('report.payroll.export');
  Route::post('report/payroll/filter', [ReportController::class, 'payroll_filter'])->name('report.payroll.filter');

  Route::get('report/providentfund', [ReportController::class, 'providentfund_index'])->name('report.providentfund');
  Route::get('report/providentfund/filter', [ReportController::class, 'providentfund_filter'])->name('report.providentfund.filter');
  Route::get('report/providentfund/export', [ReportController::class, 'providentfund_export'])->name('report.providentfund.export');

  Route::get('report/tax', [ReportController::class, 'tax_index'])->name('report.tax');
  Route::get('report/tax/filter', [ReportController::class, 'tax_filter'])->name('report.tax.filter');
  Route::get('report/tax/export', [ReportController::class, 'tax_export'])->name('report.tax.export');

  Route::get('report/payslip', [ReportController::class, 'payslip_index'])->name('report.payslip');
  Route::post('report/payslip/payslip_send_mail', [ReportController::class, 'payslip_send_mail'])->name('report.payslip.send.mail');
  Route::get('report/payslip/export', [ReportController::class, 'payslip_export'])->name('report.payslip.export');

  Route::get('report/status', [ReportController::class, 'status_index'])->name('report.status');
  Route::get('report/status/export', [ReportController::class, 'status_export'])->name('report.status.export');

  Route::get('report/budget', [ReportController::class, 'budget_index'])->name('report.budget');
  Route::get('report/budget/export', [ReportController::class, 'budget_export'])->name('report.budget.export');
  Route::get('report/projectreport', [ReportController::class, 'projectreport_index'])->name('report.projectreport');
  Route::get('report/projectreport/export', [ReportController::class, 'projectreport_export'])->name('report.projectreport.export');
 
  //20-10-23 FRCS Report
  Route::get('report/frcsreport', [ReportController::class, 'frcsreport_index'])->name('report.frcsreport');
  Route::get('report/frcsreport/export', [ReportController::class, 'frcsreport_export'])->name('report.frcsreport.export');
  Route::post('report/frcsreport/filter', [ReportController::class, 'frcs_filter'])->name('report.frcs.filter');
  
  //Billing
  Route::post('/billing', [BillingController::class, 'index'])->name('billing');
  Route::post('/billing/pay', [BillingController::class, 'pay'])->name('billing.pay');
  Route::get('/billing/plan', [BillingController::class, 'plan'])->name('billing.plan');
  Route::get('/billing/invoice', [BillingController::class, 'invoice'])->name('billing.invoice');

  //Payroll settings 
  Route::get('payroll-setting-hourly', [PayrollSettingsController::class, 'index'])->name('payroll-setting-hourly.index');
  Route::get('payroll-setting-hourly/create/{id}', [PayrollSettingsController::class, 'create'])->name('payroll-setting-hourly.create');
  Route::post('payroll-setting-hourly/store', [PayrollSettingsController::class, 'store'])->name('payroll-setting-hourly.store');


  // checkin checkout time
  Route::get('check-in-out-time', [CheckInOutTime::class, 'index'])->name('checkinout');
  Route::post('check-in-out-time/update/{id}', [CheckInOutTime::class, 'update'])->name('checkinout.update');

  //payroll budget
  Route::resource('payroll-budget', PayrollBudgetController::class);


  //splitpayment
  Route::get('split_payment', [SplitPaymentController::class, 'index'])->name('split_payment.wallet');

  //invoice
  Route::resource('invoice', InvoiceController::class);
  //Route::get('split_payment',[SplitPaymentController::class,'index'])->name('split_payment.wallet');

  //Route::get('/view_invoice/{id}', 'InvoiceController@index')->name('example');



  Route::get('view_invoice/{id}', [InvoiceController::class, 'view_invoice'])->name('view_invoice');
  Route::get('generate_invoice', [InvoiceController::class, 'generate_invoice'])->name('generate_invoice');
  Route::get('download_invoice/{id}', [InvoiceController::class, 'download_invoice'])->name('download_invoice');
  Route::get('email_invoice_download/{id}', [InvoiceController::class, 'download_email_invoice'])->name('email_invoice_download');
  Route::get('pay_invoice/{id}', [InvoiceController::class, 'pay_invoice'])->name('pay_invoice');
  //Route::get('transaction-status/{id}', [InvoiceController::class, 'transaction_status'])->name('transaction_status');
  Route::any('/checkresponse', [InvoiceController::class, 'checkResponse'])->name('checkresponse');


  //Cards 04-09-23
  Route::resource('cards', CardController::class)->except(['show']);

  //BillingEmails
  Route::resource('billing_emails', BillingEmailController::class)->except(['show']);

  //24-07-23
  Route::resource('meetings', EmployerMeetingsController::class)->except(['show']);

  //Meetings
  Route::resource('meeting', MeetingController::class)->except(['show']);
  Route::get('meeting/view/{id}', [MeetingController::class, 'view_details'])->name('meeting.details');

// Robin Code 01-09-23 Request Advance Approve/Reject etc

Route::resource('advance', AdvanceController::class)->except(['show']);
Route::get('respond_advance_request', [AdvanceController::class, 'respond_advance_request'])->name('advance.respond_advance_request');

//End
// Robin 14-09-23
Route::get('generate_web', [PayrollController::class, 'generate_web'])->name('payroll.generate.web');

//robin 18-09-23
Route::get('payroll-revert-form', [PayrollController::class, 'revert_form'])->name('payroll.revert.form');

Route::get('revert_web', [PayrollController::class, 'revert_web'])->name('payroll.revert.web');

Route::post('/process-payment', [BSPPaymentController::class, 'sendPaymentRequest'])->name('process-payment');
Route::post('https://uat2.yalamanchili.in/pgsim/checkresponse',  [BSPPaymentController::class, 'handleResponse'])->name('handleResponse');

Route::get('bred_bank_template', [PayrollCalculationController::class,'bred_bank_template'])->name('bred_bank_template');



Route::get('bred_bank_template', [PayrollCalculationController::class,'bred_bank_template'])->name('bred_bank_template');

Route::get('pc1_format', [PayrollCalculationController::class,'pc1_format'])->name('pc1_format');


Route::get('downloadFile', [PayrollCalculationController::class,'downloadFile'])->name('downloadFile');


//advance_request_approve_decline_edit





});
