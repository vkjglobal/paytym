<?php

use App\Events\AdminNotification;
use App\Events\MyEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;

Route::get('privacy_policy', function () {
    return view('home.privacy_policy');
})->name('privacy_policy');
Route::get('/',[HomeController::class,'show'])->name('paytym.home');
Route::get('subplan/{id}',[HomeController::class,'subscriptionPayment'])->name('paytym.home.subplan');
//Route::get('contact',[HomeController::class,'contactUs'])->name('paytym.home.contact');


Route::get('admin_notificationss', function () {
     // // After an admin action that requires a notification
            $message = 'Something that requires admin attention.';
           // event(new MyEvent('hello world'));
            event(new AdminNotification($message));
})->name('admin_notificationss');