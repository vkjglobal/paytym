<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{

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

    public function create_leaves(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'name' => 'required',
            'date' => 'required',
            'type' => 'required',
            'country_id' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $employer_id = $request->employer_id;
        $name = $request->name;
        $date = $request->date;
        $type = $request->type;
        $country_id = $request->country_id;

        $holiday = new Leaves();
        $holiday->employer_id = $employer_id;
        $holiday->date = $date;
        $holiday->name = $name;
        $holiday->type = $type;
        $holiday->country_id = $country_id;
        $issave = $holiday->save();

        if ($issave) {
            return response()->json([
                'message' => "Holiday Added Successfully",
                'Details' =>  $holiday,
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }

    public function list_leaves(Request $request)
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

        $leave_list = Leaves::where('employer_id', $request->employer_id)->get();
        if ($leave_list) {
            return response()->json([
                'message' => "Listed Successfully",
                'leave_list' =>  $leave_list,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records found"
            ], 200);
        }
    }

    public function delete_leave(Request $request)
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

        $leave_delete=Leaves::where('id', $request->id)->delete();
        if($leave_delete)
        {
            return response()->json([
                'message' => "Deleted Successfully"
            ], 200);
        }
        else{
            return response()->json([
                'message' => "Something went Wrong"
            ], 200);
        }
    }
}
