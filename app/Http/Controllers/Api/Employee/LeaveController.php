<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    //

 // List Leave Requests
 public function get_holidays(Request $request)
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


     $leave = Leaves::where('employer_id', $request->employer_id)->get();

     if (count($leave) > 0) {
         return response()->json([
             'message' => "Holidays  List",
             'leave' => $leave,
         ], 200);
     } else {
         return response()->json([
             'message' => "No Holidays present"
         ], 400);
     }
 }




}
