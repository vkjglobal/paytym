<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeExtraDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    //
    public function extra_details(Request $request)
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

        if ($request->employee_id){
            $extra_details = EmployeeExtraDetails::where('employer_id', $employer_id)
        ->where('employee_id', $request->employee_id)->with('users')->get();
        }else{
            $extra_details = EmployeeExtraDetails::where('employer_id', $employer_id)
        ->with('users')->get();
        }
        


        if($extra_details)
        {
            return response()->json([
                'message' => 'Extra Details List',
                'extra_details' => $extra_details
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'No records Found',
        
            ], 200);
        }
    
    }
}
