<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerBusiness;
use Auth;

class PayrollSettingsController extends Controller
{
    public function index(){

        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Index')), null],
        ];
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.payroll_settings.show_business',compact('businesses','breadcrumbs'));
    }
}
