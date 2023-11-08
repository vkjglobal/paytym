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
                [(__('Payroll Settings')), null],
            ];
            $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
            return view('employer.payroll_settings.show_business',compact('businesses','breadcrumbs'));
        
    }

    public function create($id){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Payroll Settings')), null],
        ];
        return view('employer.payroll_settings.create',compact('breadcrumbs','id'));
    }

    public function store(Request $request){
        $request = $request->validate([
            'over_time_rate' => 'numeric|nullable',
            'double_time_rate' => 'numeric|nullable',
            'business_id' => 'numeric',
            'extrahours_at_overtime_rate' => 'nullable',
        ]);

        $setting = PayrollSetting::where('employer_business_id', $request['business_id'])->first();
        //dd($setting);
        if(!$setting){
            $setting = new PayrollSetting();
            $setting->employer_business_id = $request['business_id'];
        }
        $setting->over_time_rate = $request['over_time_rate'];
        $setting->double_time_rate = $request['double_time_rate'];
        $setting->extrahours_at_overtime_rate = $request['extrahours_at_overtime_rate'];
        $issave = $setting->save();
        if($issave){
            notify()->success(__('Payslip settings added successfully'));
        } else {
            notify()->error(__('Failed to add Payslip settings. Please try again'));
        }
        return redirect()->back();
    }
}
