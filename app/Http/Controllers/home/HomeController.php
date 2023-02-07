<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Banner;
use App\Models\Cms;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show(){
        $subscription = Subscription::where('status', '1')->get();
        $banner = Banner::get();
        $cms = Cms::get();
       
    $about = Cms::where('cms_type','like','%about%') -> first();
    $foremployers = Cms::where('cms_type','like','%for employers%') -> first();
    $foremployees = Cms::where('cms_type','like','%for employees%') -> first();
    $howitworks = Cms::where('cms_type','like','%registration%') -> first();
    $empwebfeatures = Cms::where('cms_type','like','%employer web features%') -> first();
    $testimonial = Cms::where('cms_type','like','%testimonial%') -> first();
    $showcase = Cms::where('cms_type','like','%showcase%') -> first();
    $pricing = Cms::where('cms_type','like','%pricing%') -> first();
      // dd($foremployees);
        return view('home.index', compact('subscription','banner','cms','about','foremployers','foremployees','showcase','howitworks','empwebfeatures','testimonial','pricing'));
    }
}
