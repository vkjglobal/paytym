<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function fetch_employees($request)
    {
        $business = $request->business;
        $branch = $request->branch;
        $department = $request->department;
        $user = $request->employee_id;
        $employer_id = Auth::guard('employer')->id();

        if ($business == '0') {
            $employee = User::Where('employer_id', $employer_id)->select('id')->get();
        } else if ($branch == '0') {
            $employee = User::Where('employer_id', $employer_id)->where('business_id', $business)->get();
        } else if ($department == '0') {
            $employee = User::Where('employer_id', $employer_id)->where('branch_id', $branch)->get();
        } else if ($user == '0') {
            $employee = User::Where('employer_id', $employer_id)->where('department_id', $department)->get();
        } else {
            $employee = [];
            $employee[]['id'] = $request->employee_id;
        }

        return $employee;
    }
}
