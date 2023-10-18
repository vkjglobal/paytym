<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Country;
use Auth;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Leave Types')), null],
        ];

        $leavetypes = LeaveType::where('employer_id', '0')->get();

        return view('admin.leave-type.index', compact('breadcrumbs', 'leavetypes'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Leave Types')), route('admin.leave-type.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $countries = Country::get();
        return view('admin.leave-type.create', compact('breadcrumbs','countries'));
    }

    public function store(Request $request)
    {
        $rules = [
            'leavetype' => 'required',
            'num_days' => 'nullable',
            // Add more rules for other fields
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $leavetype = new LeaveType();
        $leavetype->leave_type = $request['leavetype'];
        $leavetype->no_of_days_allowed = $request['num_days'];
        $leavetype->country_id = $request['country_id'];

        $leavetype->employer_id = 0;
        $issave = $leavetype->save();

        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        //return redirect()->back();
        return redirect()->route('admin.leave-type.index');
    }

    public function edit(LeaveType $leave_type)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Leave Types')), route('admin.leave-type.index')],
            [(__('Edit')), null]
        ];
        //Employer $employer
        $countries = Country::get();
        return view('admin.leave-type.edit', compact('breadcrumbs', 'leave_type','countries'));
    }

    public function update(Request $request, LeaveType $leave_type)
    {
        $rules = [
            'leavetype' => 'required',
            'num_days' => 'nullable',
            // Add more rules for other fields
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Handle validation errors
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $leave_type->no_of_days_allowed = $request['num_days'];

        $leave_type->leave_type = $request['leavetype'];
        //dd($request);
        $leave_type->country_id = $request['country_id'];
        $leave_type->employer_id = 0;
        $issave = $leave_type->save();

        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        //return redirect()->back();
        return redirect()->route('admin.leave-type.index');
    }

    public function destroy(LeaveType $leave_type)
    {
        $res =  $leave_type->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }



}
