<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignBenefit;
use App\Models\User;
use App\Models\Benefit;
use Auth;

class AssignBenefitController extends Controller
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
            [(__('Assign Benefit')), null],
        ];
        $employer_id = Auth::guard('employer')->id();
        $assign_benefits = AssignBenefit::where('employer_id', $employer_id)->get();
        $users = User::where('employer_id', $employer_id)->where('status', 1)->get();
        $benefits = Benefit::where('employer_id', $employer_id)->get();

        // return($assign_allowances);
        return view('employer.benefit.assign', compact('breadcrumbs','assign_benefits', 'users', 'benefits'));
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
        $benefit = AssignBenefit::where('user_id', $request->employee_id)->
                                    where('benefit_id', $request->benefit)->first();


        $employer_id = Auth::guard('employer')->id();
        $data = new AssignBenefit();
        $data->employer_id = $employer_id;
        $data->user_id = $request->employee_id;
        $data->benefit_id = $request->benefit;
        $data->rate = number_format((float)$request->rate, 2);//$request->rate;

        if($benefit){
            notify()->error(__('Already exists'));
        }else{
            $res = $data->save();
            if ($res) {
                notify()->success(__('Added successfully.'));
            } else {
                notify()->error(__('Failed to add. Please try again'));
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
        $data = AssignBenefit::find($id);
        $data->benefit_id= $request->benefit;
        $data->rate = number_format((float)$request->rate, 2);//$request->rate;

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
        $data = AssignBenefit::find($id);

        $res = $data->delete();
        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }
        return redirect()->back();
    }
}
