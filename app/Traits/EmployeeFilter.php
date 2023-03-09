<?php

namespace App\Traits;

use App\Models\User;

trait EmployeeFilter
{
    public function report_filter($request)
{
        if($request->business == null && $request->user != null && $request->branch != null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('branch_id', $request->branch)->where('department_id', $request->department)->get();
        }else if($request->business != null && $request->user == null && $request->branch != null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())
            ->where('business_id', $request->business)->where('branch_id', $request->branch)
            ->where('department_id', $request->department)->get();
        }elseif($request->business != null && $request->user != null && $request->branch == null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('business_id', $request->business)
            ->where('department_id', $request->department)->get();
        }elseif($request->business != null && $request->user != null && $request->branch != null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('business_id', $request->business)->where('branch_id', $request->branch)->get();
        }
        //////
        elseif($request->user == null && $request->business == null && $request->branch != null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())->where('branch_id', $request->branch)
            ->where('department_id', $request->department)->get();
        }elseif($request->user == null && $request->business != null && $request->branch == null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())
            ->where('business_id', $request->business)
            ->where('department_id', $request->department)->get();
        }elseif($request->user == null && $request->business != null && $request->branch != null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())
            ->where('business_id', $request->business)->where('branch_id', $request->branch)->get();
        }elseif($request->user != null && $request->business == null && $request->branch == null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('department_id', $request->department)->get();
        }elseif($request->user != null && $request->business == null && $request->branch != null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('branch_id', $request->branch)->get();
        }elseif($request->user != null && $request->business != null && $request->branch == null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('business_id', $request->business)->get();
        }
        /////
        elseif($request->user == null && $request->business == null && $request->branch == null && $request->department != null){
            $employees = User::where('employer_id', $this->employer_id())
            ->where('department_id', $request->department)->get();
        }
        elseif($request->user == null && $request->business == null && $request->branch != null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())->where('branch_id', $request->branch)
            ->get();
        }
        elseif($request->user == null && $request->business != null && $request->branch == null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())
            ->where('business_id', $request->business)->get();
        }
        elseif($request->user != null && $request->business == null && $request->branch == null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)->get();
        }
        //////
        elseif($request->user == null && $request->business == null && $request->branch == null && $request->department == null){
            $employees = User::where('employer_id', $this->employer_id())->get();
        }
        ///////
        else{
            $employees = User::where('employer_id', $this->employer_id())->where('id', $request->user)
            ->where('business_id', $request->business)->where('branch_id', $request->branch)
            ->where('department_id', $request->department)->get();
        }
    return $employees;
}
}
