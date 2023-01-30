<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
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
        $annualLeaves = LeaveRequest::where('type','annual')->where('status','1')->count();
        $user = User::where('status','1')->count();
        $branches= Branch::where('employer_id', Auth::guard('employer')->user()->id)->count();
        $departments= Department::where('employer_id', Auth::guard('employer')->user()->id)->count();
        return view('employer.home',compact('annualLeaves','user','branches','departments'));
    }
}
