<?php

namespace App\Http\Controllers\Api\Employee;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    //
    public function check_in(Request $request)
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


        $now = new \DateTime();
        $attendance = new Attendance();
        $attendance->user_id = Auth::user()->id;
        $attendance->employer_id = $request->employer_id;
        $attendance->check_in = $now;
        $attendance->date = $now;

        $res = $attendance->save();

        if ($res) {
            return response()->json([
                'message' => "Checked in Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }


    public function check_out(Request $request)
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


        $now = new \DateTime();
        $date = date('Y-m-d');
        $user_id = Auth::user()->id;
        $attendance =  Attendance::where('user_id',$user_id)->where('date',$date)->first();
        if($attendance)
        {
            // $check_in=$attendance->check_in;
            // $total_time=$now - $check_in;
            $attendance->check_out=$now;
            $attendance->date = $now;
            $attendance->employer_id = $request->employer_id;
            $attendance->status='1'; // need to do the status check 
            $res = $attendance->save();
        if ($res) {
            return response()->json([
                'message' => "Checked Out Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
        }
        else
        {
            return response()->json([
                'message' => "user doesn't  checked in"
            ], 400);
        }
        //$attendance->check_out = $now;
        $res = $attendance->save();
        if ($res) {
            return response()->json([
                'message' => "Checked in Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }


    public function check_in_by_scan(Request $request)
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
        $now = new \DateTime();
        $attendance = new Attendance();
        $attendance->user_id = Auth::user()->id;
        $attendance->employer_id = $request->employer_id;
        $attendance->check_in = $now;
        $attendance->date = $now;

        $res = $attendance->save();

        if ($res) {
            return response()->json([
                'message' => "Checked in Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }


    public function check_out_by_scan(Request $request)
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
        $now = new \DateTime();
        $date = date('Y-m-d');
        $user_id = Auth::user()->id;
        $attendance =  Attendance::where('user_id',$user_id)->where('date',$date)->first();
        if($attendance)
        {
            // $check_in=$attendance->check_in;
            // $total_time=$now - $check_in;
            $attendance->check_out=$now;
            $attendance->date = $now;
            $attendance->employer_id = $request->employer_id;
            $attendance->status='1'; // need to do the status check 
            $res = $attendance->save();
        if ($res) {
            return response()->json([
                'message' => "Checked Out Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
        }
        else
        {
            return response()->json([
                'message' => "user doesn't  checked in"
            ], 400);
        }
        //$attendance->check_out = $now;
        $res = $attendance->save();
        if ($res) {
            return response()->json([
                'message' => "Checked in Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }


    public function attendance(Request $request)
    {
        $now = new \DateTime();
        $year=date("Y");
        $user_id = Auth::user()->id;
        $history=[];
        $history=Attendance::where('user_id',$user_id)
        ->whereYear('created_at', '=',$year)->get();

        return response()->json([
            'message' => "Attendence Details Listed Below",
            'history'=>$history,
        ], 200);

    }


    public function check_in_check_out_list(Request $request)
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
        $year=date("Y");
        $user_id = Auth::user()->id;
        $history=[];
        $history=Attendance::with('user')->where('employer_id',$request->employer_id)
        ->whereYear('created_at', '=',$year)->get();
        return response()->json([
            'message' => "Checkin- Checkout  Details Listed Below",
            'history'=>$history,
        ], 200);
    }
    





}
