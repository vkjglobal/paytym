<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Cms;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show(){
        $subscription = Subscription::get();
        $cms = Cms::get();
       // return view('home.index','subscription');
        return view('home.index', compact('subscription','cms'));
    }
}
