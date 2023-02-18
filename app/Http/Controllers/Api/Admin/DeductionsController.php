<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use Illuminate\Http\Request;
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
        $deductions = Deduction::where('employer_id', $employer_id)->first();
        if ($deductions) {
            return response()->json([
                'message' => "Deductions Listed Successfuly",
                'Details' =>  $deductions,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records",
            ], 200);
        }
    }


    public function deductions_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'name' => 'required',
            'amount' => 'required',
            'percentage' => 'required',
            'description' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $name = $request->name;
        $amount = $request->amount;
        $percentage = $request->percentage;
        $description = $request->description;
        $employer_id = $request->employer_id;
        $deduction = new Deduction();
        $deduction->employer_id = $employer_id;
        $deduction->name = $name;
        $deduction->amount = $amount;
        $deduction->percentage = $percentage;
        $deduction->description = $description;

        $issave = $deduction->save();
        if ($issave) {
            return response()->json([
                'message' => "Deductions Added Successfuly",
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong",
            ], 200);
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
        $deduction = Deduction::where('id', $id)->delete();
        if ($deduction) {
            return response()->json([
                'message' => "Deleted Successfully"
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong"
            ], 200);
        }
    }

    
}
