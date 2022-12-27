<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;


Route::get('/',[HomeController::class,'show'])->name('paytym.home');
