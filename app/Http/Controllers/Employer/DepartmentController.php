<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\branch\StoreDepartmentRequest;
use App\Http\Requests\branch\UpdateDepartmentRequest;
use App\Models\Branch;
use App\Models\Department;
use Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $breadcrumbs = [
                [(__('Dashboard')), route('employer.department.index')],
                [(__('departments')), null],
            ];
    
            $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
    
            return view('employer.departments.index', compact('breadcrumbs', 'departments'));
        }
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
            [(__('Departments')), route('employer.department.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.departments.create', compact('breadcrumbs','branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        $validated = $request->validated();
        $department = new Department();
        $department->employer_id = Auth::guard('employer')->user()->id;
        $department->dep_name = $validated['dep_name'];
        $department-> branch_id = $validated['branch'];
        $issave = $department->save();
        if($issave){
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
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
            [(__('Departments')), route('employer.department.index')],
            [(__('Edit')), null],
        ];
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $department = Department::findOrFail($id);   
        return view('employer.departments.edit',compact('breadcrumbs','department','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $validated = $request->validated();
        $department->employer_id = Auth::guard('employer')->user()->id;
        $department->dep_name = $validated['dep_name'];
        $department-> branch_id = $validated['branch'];
        $issave = $department->save();
        if($issave){
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect('employer/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Department::findOrFail($id)->delete();
    
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    //Change department Status
    public function changeStatus(Request $request){
        $department = Department::find($request->department_id);
        $department->status = $request->status;
        $res=$department->save();
        if($res){
        return response()->json(['success' => 'Status change successfully.']);
        }
    }
}
