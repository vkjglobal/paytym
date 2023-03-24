<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignDeduction;
use App\Models\Deduction;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DeductionsController extends Controller
{
    //
    public function deductions_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $employer_id = $request->employer_id;
        // $deduction = AssignDeduction::with(['employee:id,first_name,last_name,branch_id','employee.branch:id,name','deduction:id,name,description'])->where('employer_id', $employer_id)->get();
        // $total_deduction =  AssignDeduction::;
        $deduction = User::select(['id', 'first_name', 'last_name', 'branch_id','department_id'])->with('assign_deduction.deduction:id,name,description')
                    ->where('employer_id', $employer_id)->get();
        // $employees = User::where('employer_id', $employer_id)->get();
        // foreach($deduction as $employee){
        //     $total_deduction = AssignDeduction::where('user_id', $employee->id)->sum('rate');
        //     $deduction->total_deduction = $total_deduction;
        //     // $deduction->save();
        // }
        $deductions_types = Deduction::select(['id','employer_id','name','description'])->where('employer_id', $employer_id)->get();
          


        if ($deduction) {
            return response()->json([
                'message' => "Success",
                'deductions'=>$deduction,
                'deductions types'=>$deductions_types,
            ], 200);
        } else {
            return response()->json([
                'message' => "Fail"
            ], 400);
        }
    }


    public function deductions_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            // 'name' => 'required',
            // 'amount' => 'required',
            // 'percentage' => 'required',
            // 'description' => 'required',
            'rate' => 'required',
            'user_id' => 'required',
            'deduction_id' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        // $name = $request->name;
        // $amount = $request->amount;
        // $percentage = $request->percentage;
        // $description = $request->description;
        $deduction_id = $request->deduction_id;
        $user_id = $request->user_id;
        $employer_id = $request->employer_id;
        $rate = $request->rate;
        $deduction = new AssignDeduction();
        $deduction->employer_id = $employer_id;
        // $deduction->name = $name;
        // $deduction->amount = $amount;
        // $deduction->percentage = $percentage;
        // $deduction->description = $description;
        $deduction->rate = $rate;
        $deduction->deduction_id = $deduction_id;
        $deduction->user_id = $user_id;

        $issave = $deduction->save();
        if ($issave) {
            return response()->json([
                'message' => "Deductions Added Successfuly",
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong",
            ], 400);
        }
    }


    public function deductions_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' =>  'required',

        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $id = $request->id;
        $deduction = AssignDeduction::where('user_id', $id)->delete();
        if ($deduction) {
            return response()->json([
                'message' => "Deleted Successfully"
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong"
            ], 400);
        }
    }

    
}
