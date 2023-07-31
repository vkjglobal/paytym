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
    public function show()
    {
        $subscription = Subscription::where('status', '1')->get();
        $banner = Banner::where('status', '1')->get();
        $bannercount = Banner::where('status', '1')->get()->count();
        $cms = Cms::get();
        $about = Cms::where('cms_type', 'like', '%About%')->where('status', '1')->first();
        $foremployers = Cms::where('cms_type', 'like', '%Employers%')->where('status', '1')->first();
        $foremployees = Cms::where('cms_type', 'like', '%Employees%')->where('status', '1')->first();
        $howitworks = Cms::where('cms_type', 'like', '%registration%')->where('status', '1')->first();
        $empwebfeatures = Cms::where('cms_type', 'like', '%Web Features%')->where('status', '1')->first();
        $testimonial = Cms::where('cms_type', 'like', '%Testimonials%')->where('status', '1')->get();
        $showcase = Cms::where('cms_type', 'like', '%showcase%')->where('status', '1')->first();
        $pricing = Cms::where('cms_type', 'like', '%pricing%')->where('status', '1')->first();
        $employee_management = Cms::where('identifier', 1)->where('status', '1')->first();
        $payroll_management = Cms::where('identifier', 2)->where('status', '1')->first();
        $deposit = Cms::where('identifier', 3)->where('status', '1')->first();
        $payroll_tax = Cms::where('identifier', 4)->where('status', '1')->first();
        
        $analytics_report = Cms::where('identifier', 5)->where('status', '1')->first();
        $chat = Cms::where('identifier', 6)->where('status', '1')->first();
        $employer = Auth::guard('employer')->user();

        return view('home.index', compact('chat','analytics_report','payroll_tax','deposit','payroll_management','employee_management','subscription', 'banner', 'bannercount', 'cms', 'about', 'foremployers', 'foremployees', 'showcase', 'howitworks', 'empwebfeatures', 'testimonial', 'pricing', 'employer'));
    }

    public function subscriptionPayment($id)
    {
        $subscription = Subscription::where('status', '1')->get();
        $pricing = Cms::where('cms_type', 'like', '%pricing%')->first();
        $plan = Subscription::find($id);
        if (Auth::guard('employer')->user()) {
            //dd(Auth::guard('employer')->user());
            //return view('employer.payment.plan', compact('id','subscription','pricing'));
            return view('employer.billing.index', compact('id', 'subscription', 'pricing', 'plan'));
        } else {
            //dd(Auth::guard('employer')->user());
            return view('employer.auth.login');
        }
    }
}
