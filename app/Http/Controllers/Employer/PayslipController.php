<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerBusiness;
use App\Models\PayslipSetting;
use Auth;

class PayslipController extends Controller
{
    public function index(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Payslip Settings')), null],
        ];
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.payslip.show_business',compact('businesses','breadcrumbs'));
    }

    public function create($id){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Index')), null],
        ];
        return view('employer.payslip.create',compact('breadcrumbs','id'));
    }

    public function store(Request $request){
        $setting = PayslipSetting::where('employer_business_id', $request->business_id)->first();
        if (!$setting) {
            $setting = new PayslipSetting();
            $setting->employer_business_id = $request->business_id;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs(
                'uploads/payslip_logo',
                urlencode(time()) . '_' . uniqid() . '_' . $request->logo->getClientOriginalName(),
                'public'
            );
            $setting->logo = $path;
        }
        $setting->template = 'payslip.templates.' . $request->template;
        $issave = $setting->save();
    
        if($issave){
            notify()->success(__('Payslip settings added successfully'));
        } else {
            notify()->error(__('Failed to add Payslip settings. Please try again'));
        }
        return redirect()->back();
    }
    public function view_payslip(){
        return view('employer.payslip.templates.default');
    }


}
