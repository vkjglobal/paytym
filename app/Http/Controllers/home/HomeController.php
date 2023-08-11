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
        $about = Cms::where('cms_type', 'like', '%Paytym HR and Payroll%')->where('status', '1')->first();
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

        //new 11-08-23
        $payslips = Cms::where('identifier', 7)->where('status', '1')->first();
        $leaves = Cms::where('identifier', 8)->where('status', '1')->first();
        $personalprofile = Cms::where('identifier', 9)->where('status', '1')->first();
        $depositaccounts = Cms::where('identifier', 10)->where('status', '1')->first();
        $shiftroster = Cms::where('identifier', 11)->where('status', '1')->first();
        $appchat = Cms::where('identifier', 12)->where('status', '1')->first();

        $improvespeed = Cms::where('identifier', 13)->where('status', '1')->first();
        $offermobileaccess = Cms::where('identifier', 14)->where('status', '1')->first();
        $protectdata = Cms::where('identifier', 15)->where('status', '1')->first();
        $easilyscalebusiness = Cms::where('identifier', 16)->where('status', '1')->first();
        $offeremployeeservice = Cms::where('identifier', 17)->where('status', '1')->first();
        $reducecost = Cms::where('identifier', 18)->where('status', '1')->first();
        $envfriendly = Cms::where('identifier', 19)->where('status', '1')->first();
        $effortlessstat = Cms::where('identifier', 20)->where('status', '1')->first();


        return view('home.index', compact('chat','analytics_report','payroll_tax','deposit','payroll_management','employee_management','subscription', 'banner', 'bannercount', 'cms', 'about', 'foremployers', 'foremployees', 'showcase', 'howitworks', 'empwebfeatures', 'testimonial', 'pricing', 'employer',
                                            'payslips','leaves','personalprofile','depositaccounts','shiftroster','appchat',
                                        'improvespeed','offermobileaccess','protectdata','easilyscalebusiness','offeremployeeservice','reducecost','envfriendly','effortlessstat'));
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
