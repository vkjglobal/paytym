<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    public function list_employees(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }


        $employer_id=$request->employer_id;
        $employees=User::with('payroll')->with('department')->with('branch')->where('employer_id',$employer_id)->get();
        if($employees)
        {
            return response()->json([
                'message' => "Listed Successfully",
                'employee_list' =>  $employees,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => "No Records found"
            ], 200);
        }

    }


    public function list_employees_departmentwise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'department_id' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $employer_id=$request->employer_id;
        $department_id=$request->department_id;
        $employees=User::where('employer_id',$employer_id)->where('department_id',$department_id)->get();
        if($employees->count()>0)
        {
            return response()->json([
                'message' => "Departmentwise employees Listed Successfully",
                'employee_list' =>  $employees,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => "No Records found"
            ], 200);
        }
    }

    public function list_employees_branchwise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'branch_id' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $employer_id=$request->employer_id;
        $branch_id=$request->branch_id;
        $employees=User::where('employer_id',$employer_id)->where('branch_id',$branch_id)->get();
        if($employees->count()>0)
        {
            return response()->json([
                'message' => "Branch wise employees Listed Successfully",
                'employee_list' =>  $employees,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => "No Records found"
            ], 200);
        }
    }

// 02-08-23

    //list_employees_businesswise

    public function list_employees_businesswise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'business_id' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $employer_id=$request->employer_id;
        $business_id=$request->business_id;
        $employees=User::where('employer_id',$employer_id)->where('business_id',$business_id)->get();
        if($employees->count()>0)
        {
            return response()->json([
                'message' => "Business wise employees Listed Successfully",
                'employee_list' =>  $employees,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => "No Records found"
            ], 200);
        }
    }

}
