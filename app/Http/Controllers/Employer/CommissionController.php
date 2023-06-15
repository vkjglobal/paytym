<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Commission;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{

    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Commission')), null],
        ];
        $employer_id = Auth::guard('employer')->id();
        $users = User::where('employer_id', $employer_id)->where('status', 1)->get();
        $commissions = Commission::where('employer_id', $employer_id)->get();
        $departments = Department::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get(); 
        $branches = Branch::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get(); 
        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get(); 
        return view('employer.commission.index', compact('businesses','branches','departments','breadcrumbs','commissions', 'users'));
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
        $validated = $request->validate([
            'employee_id' => 'required',
            'rate' => 'required|numeric',
        ]);
        
        $employee = Commission::where('user_id', $request->employee_id)->first();

        $employer_id = Auth::guard('employer')->id();
        $data = new Commission();
        $data->employer_id = $employer_id;
        $data->user_id = $request->employee_id;
        $data->rate = $request->rate;

        if($employee){
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


    public function update(Request $request, $id)
    {
        // $employee = Commission::where('user_id', $request->employee_id)->first();
        // $employer_id = Auth::guard('employer')->id();
        $validated = $request->validate([   
            'rate' => 'required|numeric',
        ]);

        $data = Commission::find($id);
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
        $data = Commission::find($id);

        $res = $data->delete();
        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }
        return redirect()->back();
    }
}
