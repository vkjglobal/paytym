<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\AssignDeduction;

use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('employer.auth:employer');
    }

    /**
     * Show the Employer dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $employer = Auth::guard('employer')->user();
        $annualLeaves = LeaveRequest::where('type','annual')->where('status','1')->count();
        $user = User::where('status','1')->count();
        $branches= Branch::where('employer_id', Auth::guard('employer')->user()->id)->count();
        $departments= Department::where('employer_id', Auth::guard('employer')->user()->id)->count();
        $today = Carbon::today();
        $formatted_date = $today->format('Y-m-d');
       
        $checked_in = Attendance::whereNotNull('check_in')->where('date',$formatted_date)->count();
        $checked_out = Attendance::whereNotNull('check_out')->where('date',$formatted_date)->count();
        $on_annual_leave = LeaveRequest::where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('type','annual')->count();
        $on_sick_leave = LeaveRequest::where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('type','sick')->count();
        //dd($on_sick_leave);
        $absentees = $user - $checked_in;
        $totaldayoffs = $user - $checked_in;
        
        $loan= Deduction::where('employer_id', Auth::guard('employer')->user()->id)->where('name','loan')->get();
        $loanid= $loan->pluck('id');
        // $totalloans = AssignDeduction::where('deduction_id',$loanid)->count();
        if(isset($totalloans))
        $totalloans = AssignDeduction::where('deduction_id',$loanid)->count();
        else
        $totalloans = 0;
        $lwop = LeaveRequest::where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('type','LWOP')->count();
        $mia = 0;
        //dd($checked_in);
        return view('employer.home',compact('employer','annualLeaves','user','branches','departments','checked_in',
                                            'checked_out','on_annual_leave','on_sick_leave','absentees','totaldayoffs','lwop','totalloans','mia'));
    }
}
