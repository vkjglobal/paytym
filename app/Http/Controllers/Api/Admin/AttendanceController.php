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
            'attendance_id' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $employee_id = $request->employee_id;
        $status = $request->status;
        $attendance_id = $request->attendance_id;

        if (!$request->filled('reason')) {
            $reason = 'No reason';
        }else{
            $reason = $request->reason;
        }
        $attendance = Attendance::where('user_id', $employee_id)->where('id', $attendance_id)->first();
        if ($attendance) {
            if ($status == '0') {
                $attendance->approve_reject = '0';
                $attendance->reason = $request->reason;
                $message = 'Your attendance is rejected.';
            } else {
                $attendance->approve_reject = '1';
                $message = 'Your attendance is approved.';
            }
            $issave = $attendance->save();
            if ($issave) {
                $otherController = new AuthController();
                $result = $otherController->push_notification($request,$request->employee_id,$message);
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
            'attendance_id' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $attendance_id = $request->attendance_id;
        $attendance = Attendance::where('user_id', $request->employee_id)->where('id', $attendance_id)->first();
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
            $attendance->status = "1";
            $issave = $attendance->save();

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
