<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;


Route::get('/',[HomeController::class,'show'])->name('paytym.home');
Route::get('subplan/{id}',[HomeController::class,'subscriptionPayment'])->name('paytym.home.subplan');
//Route::get('contact',[HomeController::class,'contactUs'])->name('paytym.home.contact');
