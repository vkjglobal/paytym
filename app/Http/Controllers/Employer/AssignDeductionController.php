<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use App\Models\AssignAllowance;
use App\Models\AssignDeduction;
use App\Models\Deduction;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use App\Models\EmployerBusiness;
use Auth;

class AssignDeductionController extends Controller
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
            [(__('Assign Deduction')), null],
        ];
        $employer_id = Auth::guard('employer')->id();
        $assign_deductions = AssignDeduction::where('employer_id', $employer_id)->get();
        $users = User::where('employer_id', $employer_id)->where('status', 1)->get();
        $deductions = Deduction::where('employer_id', $employer_id)->get();
        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $branches = Branch::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $departments = Department::where('employer_id', Auth::guard('employer')->user()->id)->get();
        // return($assign_allowances);
        return view('employer.deduction.assign', compact('breadcrumbs', 'assign_deductions',  'users', 'deductions', 'businesses', 'branches', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $otherController = new GeneralController();
        $employee = $otherController->fetch_employees($request);
        foreach ($employee as $key => $value) {
            $deduction = AssignDeduction::where('user_id', $value['id'])->where('deduction_id', $request->deduction)->first();
            if ($deduction) {
                //  notify()->error(__('Already exists'));
            } else {
                $employer_id = Auth::guard('employer')->id();
                $data = new AssignDeduction();
                $data->employer_id = $employer_id;
                $data->user_id = $value['id'];
                $data->deduction_id = $request->deduction;
                $data->rate = $request->rate;
                $res = $data->save();
                // if ($res) {
                //     //notify()->success(__('Added successfully.'));
                // } else {
                //    // notify()->error(__('Failed to add. Please try again'));
                // }
            }
        }

        return redirect()->back();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = AssignDeduction::find($id);
        $data->deduction_id = $request->deduction;
        $data->rate = $request->rate;

        $res = $data->save();
        if ($res) {
            notify()->success(__('Updated successfully.'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }



        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AssignDeduction::find($id);

        $res = $data->delete();
        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }
        return redirect()->back();
    }
}
