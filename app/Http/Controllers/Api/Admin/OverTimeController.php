<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OverTimeController extends Controller
{
    //
    public function list_overtime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $employer_id = $request->employer_id;
        $overtime_requests = Overtime::where('employer_id', $employer_id)->get();
        if ($overtime_requests) {
            return response()->json([
                'message' => "Listed Successfully",
                'employee_list' =>  $overtime_requests,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records found"
            ], 200);
        }
    }

    public function overtime_request_approve_decline_edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $status = $request->status;  //0=> Requested 1=>approved 2=>decline 3=>edit

        if ($status == '0') {
            $validator = Validator::make($request->all(), [
                'employer_id' =>  'required',
                'employee_id' =>  'required',
                'date' =>  'required',
                'total_hours' =>  'required',
                'reason' =>  'required'
            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }
            $overtime = new Overtime();
            $overtime->employer_id = $request->employer_id;
            $overtime->employee_id = $request->employee_id;
            $overtime->date = $request->date;
            $overtime->total_hours = $request->total_hours;
            $overtime->reason = $request->reason;
        } elseif ($status == '1' || $status == '2') {
            $validator = Validator::make($request->all(), [
                'id' =>  'required',
            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $overtime = Overtime::where('id', $request->id)->first();
            if ($overtime) {
                $overtime->status = $request->status;
            }
        } else {
            $overtime = Overtime::where('id', $request->id)->first();
            if ($overtime) {
                if (isset($request->date)) {
                    $overtime->date = $request->date;
                }
                if (isset($request->total_hours)) {
                    $overtime->total_hours = $request->total_hours;
                }
                if (isset($request->reason)) {
                    $overtime->reason = $request->reason;
                }
            } else {
                return response()->json([
                    'message' => "No Records Found"
                ], 200);
            }
        }
        $issave = $overtime->save();
        if ($issave) {
            return response()->json([
                'message' => "Action executed Successfully"

            ], 200);
        } else {
            return response()->json([
                'message' => "Something Went wrong"
            ], 200);
        }
    }

    // public function edit_overtime(Request $request)
    // {
    // }
}
