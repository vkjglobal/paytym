<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Models\AssignAllowance;
use App\Models\User;
use Auth;

class AssignAllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employer_id = Auth::guard('employer')->id();
        $assign_allowances = AssignAllowance::where('employer_id', $employer_id)->get();
        $users = User::where('employer_id', $employer_id)->get();
        $allowances = Allowance::where('employer_id', $employer_id)->get();
        // return($assign_allowances);
        return view('employer.allowance.assign', compact('assign_allowances',  'users', 'allowances'));
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
        $allowance = AssignAllowance::where('user_id', $request->employee_id)->
                                    where('allowance_id', $request->allowance)->first();


        $employer_id = Auth::guard('employer')->id();
        $data = new AssignAllowance();
        $data->employer_id = $employer_id;
        $data->user_id = $request->employee_id;
        $data->allowance_id = $request->allowance;
        $data->rate = $request->rate;

        if($allowance){
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
        $data = AssignAllowance::find($id);
        $data->allowance_id= $request->allowance;
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
        $data = AssignAllowance::find($id);

        $res = $data->delete();
        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }
        return redirect()->back();
    }
}