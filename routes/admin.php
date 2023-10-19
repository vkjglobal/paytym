<?php

use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomSubscriptionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EmployerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\TwilioSMSController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TaxSettingsController;
use App\Http\Controllers\Admin\TaxSettingsSrtController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Models\CustomSubscription;
use Illuminate\Support\Facades\Route;




// Dashboard
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('contact_store', [ContactController::class, 'store'])->name('contact.store');

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

    //Subscription Rj 26-12-22
    Route::get('subscription-change-status', [SubscriptionController::class, 'changeStatus'])->name('subscriptions.change.status');
    Route::resource('subscriptions', SubscriptionController::class)->except(['show']);

    // Custom Subscriptions
    Route::get('custom_subscriptions-change-status', [CustomSubscriptionController::class, 'changeStatus'])->name('custom_subscriptions.change.status');
    Route::resource('custom_subscriptions', CustomSubscriptionController::class)->except(['show']);

    //CMS
    Route::get('cms-change-status', [CmsController::class, 'changeStatus'])->name('cms.change.status');
    Route::resource('cms', CmsController::class)->except(['show']);

    //Banner
    Route::get('banner-change-status', [BannerController::class, 'changeStatus'])->name('banner.change.status');
    Route::resource('banner', BannerController::class)->except(['show']);

    // Contacts

    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    Route::post('contact', [ContactController::class, 'sendReply']);
    Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

    
    // Invoices
    Route::resource('invoice', InvoiceController::class);
    Route::post('invoice-change-status/{id}', [InvoiceController::class, 'changeStatus'])->name('invoice.change.status');

    //Support Tickets
    Route::get('supportticket', [SupportTicketController::class, 'index'])->name('supportticket');
    Route::get('supportticket-change-status', [SupportTicketController::class, 'changeStatus'])->name('supportticket.change.status');
    //Route::post('supportticket', [SupportTicketController::class, 'sendReply']);
    Route::delete('supportticket/{id}', [SupportTicketController::class, 'destroy'])->name('supportticket.destroy');
    Route::post('supportticket-send-reply', [SupportTicketController::class, 'sendReply'])->name('supportticket.send.reply');


    //Country
    Route::resource('country', CountryController::class)->except(['show']);
    Route::get('country-change-status', [CountryController::class, 'changeStatus'])->name('country.change.status');

    //Twilio Route Robin 22-02-23
    Route::get('sendSMS', [TwilioSMSController::class, 'index']);
     
     //Report
     Route::get('report/main_report',[ReportController::class, 'index'])->name('main_report');
     Route::get('report/main_report/export/', [ReportController::class, 'export'])->name('main_report.download');
     Route::post('report/main_report/filter', [ReportController::class, 'filter'])->name('main_report.filter');

     Route::get('report/invoice',[ReportController::class, 'invoice_index'])->name('report.invoice');
     Route::get('report/invoice/export/', [ReportController::class, 'invoice_export'])->name('report.invoice.download');
     Route::post('report/invoice/filter', [ReportController::class, 'invoice_filter'])->name('report.invoice.filter');


     Route::get('report/employer/export',[ReportController::class,'employer_list_export'])->name('report.employer.export');


    // Route::get('/privacy_policy', [HomeController::class, 'index'])->name('home');

   // Tax Settings

   Route::resource('tax_settings', TaxSettingsController::class)->except(['show']);

   Route::resource('tax_settings_srt', TaxSettingsSrtController::class)->except(['show']);

// 27-07-23
   Route::resource('bank', BankController::class)->except(['show']);

   //28-09-23
    //AdminEmails
  Route::resource('emails', AdminEmailController::class)->except(['show']);

   //Leave type 17-10-23
   Route::resource('leave-type', LeaveTypeController::class)->except(['show']);

    });
