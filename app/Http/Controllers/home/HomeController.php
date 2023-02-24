<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Banner;
use App\Models\Cms;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show(){
        $subscription = Subscription::where('status', '1')->get();
        $banner = Banner::where('status', '1')->get();
        $bannercount = Banner::where('status', '1')->get()->count();
        //dd($banner);
        $cms = Cms::get();
    $about = Cms::where('cms_type','like','%about%') ->where('status', '1')-> first();
    $foremployers = Cms::where('cms_type','like','%for employers%')-> where('status', '1')->first();
    $foremployees = Cms::where('cms_type','like','%for employees%')-> where('status', '1')-> first();
    $howitworks = Cms::where('cms_type','like','%registration%') -> where('status', '1')-> first();
    $empwebfeatures = Cms::where('cms_type','like','%employer web features%')-> where('status', '1')-> first();
    $testimonial = Cms::where('cms_type','like','%testimonial%') -> where('status', '1')-> first();
    $showcase = Cms::where('cms_type','like','%showcase%') -> where('status', '1') -> first();
    $pricing = Cms::where('cms_type','like','%pricing%') -> where('status', '1') -> first();
      // dd($foremployees);
      $employer = Auth::guard('employer')->user();
        return view('home.index', compact('subscription','banner','bannercount','cms','about','foremployers','foremployees','showcase','howitworks','empwebfeatures','testimonial','pricing','employer'));
    }

    public function subscriptionPayment($id)
    {
        //dd($id);
        $subscription = Subscription::where('status', '1')->get();
        $pricing = Cms::where('cms_type','like','%pricing%') -> first();
        $plan = Subscription::find($id);
        if(Auth::guard('employer')->user())
        {
            //dd(Auth::guard('employer')->user());
            //return view('employer.payment.plan', compact('id','subscription','pricing'));
            return view('employer.billing.index', compact('id','subscription','pricing','plan'));
        }
        else
        {
            //dd(Auth::guard('employer')->user());
            return view('employer.auth.login');
        }

    }
    
}
