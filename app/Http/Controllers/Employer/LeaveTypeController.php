<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use Auth;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Leave Types')), null],
        ];

        $leavetypes = LeaveType::where('employer_id', Auth::guard('employer')->user()->id)->get();

        return view('employer.leave-type.index', compact('breadcrumbs', 'leavetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Leave Types')), route('employer.leave-type.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        return view('employer.leave-type.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $leavetype->country_id = Auth::guard('employer')->user()->country_id;
        $leavetype->employer_id = Auth::guard('employer')->user()->id;
        $issave = $leavetype->save();

        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        //return redirect()->back();
        return redirect()->route('employer.leave-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveType $leave_type)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Leave Types')), route('employer.leave-type.index')],
            [(__('Edit')), null]
        ];
        //Employer $employer
        return view('employer.leave-type.edit', compact('breadcrumbs', 'leave_type'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $leave_type->country_id = Auth::guard('employer')->user()->country_id;
        $leave_type->employer_id = Auth::guard('employer')->user()->id;
        $issave = $leave_type->save();

        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        //return redirect()->back();
        return redirect()->route('employer.leave-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
