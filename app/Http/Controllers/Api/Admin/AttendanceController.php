<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Employee\AuthController;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function attendance_approve_reject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' =>  'required',
            'status' => 'required',   //0 => reject 1=>approve
            'date' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $employee_id = $request->employee_id;
        $status = $request->status;
        $date = $request->date;
        $attendance = Attendance::where('user_id', $employee_id)->whereDate('date', $date)->first();
        if ($attendance) {
            if ($status == '0') {
                $attendance->approve_reject = '0';
                $attendance->reason = $request->reason;
            } else {
                $attendance->approve_reject = '1';
            }
            $issave = $attendance->save();
            if ($issave) {
                $otherController = new AuthController();
                $result = $otherController->push_notification($request,$request->employee_id,$request->reason);
                return response()->json([
                    'message' => "Action done successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something went wrong"
                ], 200);
            }
        } else {
            return response()->json([
                'message' => "No records"
            ], 200);
        }
    }

    public function attendance_edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' =>  'required',
            'date' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $attendance = Attendance::where('user_id', $request->employee_id)->whereDate('date', $request->date)->first();
        if ($attendance) {
            if (isset($request->check_in)) {
                $attendance->check_in = $request->check_in;
            }

            if (isset($request->check_out)) {
                $attendance->check_out = $request->check_out;
            }


            if (isset($request->status)) {
                $attendance->status = $request->status;
            }

            if (isset($request->reason)) {
                $attendance->reason = $request->reason;
            }

            if (isset($request->approve_reject)) {
                $attendance->approve_reject = $request->approve_reject;
            }

            $issave = $attendance->save();
            if($issave){
                

            }
            if ($issave) {
                return response()->json([
                    'message' => "Updated Successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something Went Wrong"
                ], 200);
            }
        }
        // $attendance->check_in = $now;
        // $attendance->date = $now;
    }
}
