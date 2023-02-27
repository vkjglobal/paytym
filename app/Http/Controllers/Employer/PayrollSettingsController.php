<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerBusiness;
use App\Models\PayrollSetting;;
use Auth;

class PayrollSettingsController extends Controller
{
    public function index()
    {
                $breadcrumbs = [
                [(__('Dashboard')), route('employer.home')],
                [(__('Index')), null],
            ];
            $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
            return view('employer.payroll_settings.show_business',compact('businesses','breadcrumbs'));
        
    }

    public function create($id){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Index')), null],
        ];
        return view('employer.payroll_settings.create',compact('breadcrumbs','id'));
    }

    public function store(Request $request){
        $setting = PayrollSetting::where('employer_business_id', $request->business_id)->first();
        dd($setting->over_time_rate);
    }
}
