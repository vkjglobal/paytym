<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Branch;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
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
            [(__('Bonus')), null],
        ];
        $bonuses = Bonus::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.bonus.index', compact('breadcrumbs', 'bonuses'));
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
            [(__('Bonus')), route('employer.bonus.index')],
            [(__('Create')), null],
        ];
        $employees = User::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $departments = Department::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $branches = Branch::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        return view('employer.bonus.create', compact('breadcrumbs', 'employees', 'departments', 'branches', 'businesses'));
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
            'type' => 'required',
            'type_id' => 'required',
            'rate_type' => 'required',
            'rate' => 'required|numeric',
        ]);
       
        $type = $request->type;
        $type_id = $request->type_id;
        $rate_type = $request->rate_type;
        $rate = $request->rate;
        $employer_id = Auth::guard('employer')->id();

        if ($type == '0') { // employee
            if ($type_id == '0') {
                $selectedDepartmentId = $request->input('selected_department_id');
                $bonus_assign_to = User::Where('employer_id', $employer_id)->Where('department_id',$selectedDepartmentId)->select('id')->get();
            } else {
                $bonus_assign_to[]['id'] = $request->type_id;
                //   $bonus_assign_to = $request->type_id;
            }
        } else if ($type == '1') { // department
            if ($type_id == '0') {
                $selected_branch_id= $request->input('selected_branch_id');
                $bonus_assign_to = Department::Where('employer_id', $employer_id)
                ->Where('branch_id',$selected_branch_id)->select('id')->get();
            } else {
                $bonus_assign_to[]['id'] = $request->type_id;
            }
        } else if ($type == '2') {  //Branch

            if ($type_id == '0') {
                $selected_business_id= $request->input('selected_business_id');
            $bonus_assign_to = Branch::Where('employer_id', $employer_id)
            ->Where('business_id',$selected_business_id)->select('id')->get();
            } else {
                $bonus_assign_to[]['id'] = $request->type_id;
            }
           
        } else if ($type == '3') {  // Business

            if ($type_id == '0') {
            $bonus_assign_to = Branch::Where('employer_id', $employer_id)->select('id')->get();
            } else {
                $bonus_assign_to[]['id'] = $request->type_id;
            }
        } 
        foreach ($bonus_assign_to as $key => $value) {

            $bonus = Bonus::where('type', $request->type)->where('type_id',$value['id'])
            ->Where('rate_type',$request->rate_type)->first();
            if ($bonus) {
              //  notify()->error(__('Already exists'));
            } else {
            $data = new Bonus();
            $data->employer_id = Auth::guard('employer')->id();
            $data->type = $request->type;
            $data->type_id = $value['id'];
            $data->rate_type = $request->rate_type;
            $data->rate = $request->rate;
            $res = $data->save();
    
            if ($res) {
                notify()->success(__('Bonus added.'));
            } else {
                notify()->error(__('Failed to add bonus. Please try again'));
            }
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
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Bonus')), route('employer.bonus.index')],
            [(__('Edit')), null],
        ];
        $bonus = Bonus::find($id);
        // dd($bonus);
        $employees = User::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $departments = Department::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $branches = Branch::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();

        if ($bonus->type == 0) {
            return view('employer.bonus.edit1', compact('breadcrumbs', 'employees', 'departments', 'branches', 'businesses', 'bonus'));
        } elseif ($bonus->type == 1) {
            return view('employer.bonus.edit2', compact('breadcrumbs', 'employees', 'departments', 'branches', 'businesses', 'bonus'));
        } elseif ($bonus->type == 2) {
            return view('employer.bonus.edit3', compact('breadcrumbs', 'employees', 'departments', 'branches', 'businesses', 'bonus'));
        } elseif ($bonus->type == 3) {
            return view('employer.bonus.edit4', compact('breadcrumbs', 'employees', 'departments', 'branches', 'businesses', 'bonus'));
        } else {
            return view('employer.bonus.edit', compact('breadcrumbs', 'employees', 'departments', 'branches', 'businesses', 'bonus'));
        }
        // return view('employer.bonus.edit', compact('employees','departments','branches','businesses','bonus'));
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
        $data = Bonus::find($id);
        $data->employer_id = Auth::guard('employer')->id();
        // $data->type = $request->type;
        $data->type_id = $request->type_id;
        $data->rate_type = $request->rate_type;
        $data->rate = $request->rate;
        $res = $data->save();

        if ($res) {
            notify()->success(__('Bonus updated.'));
        } else {
            notify()->error(__('Failed to update bonus. Please try again'));
        }

        return redirect()->route('employer.bonus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bonus::find($id);
        $res = $data->delete();

        if ($res) {
            notify()->success(__('Bonus deleted.'));
        } else {
            notify()->error(__('Failed to delete bonus. Please try again'));
        }

        return redirect()->back();
    }
}
