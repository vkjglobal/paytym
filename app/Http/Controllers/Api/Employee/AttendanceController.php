<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employer;
use App\Models\LeaveRequest;
use App\Models\Roster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
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
        $attendance =  Attendance::where('user_id', $user_id)->latest()->first();
        if ($attendance) {
            // $check_in=$attendance->check_in;
            // $total_time=$now - $check_in;
            $attendance->check_out = $now;
            $attendance->date = $now;
            $attendance->employer_id = $request->employer_id;
            $attendance->status = '1'; // need to do the status check 
            // $attendance->approve_reject = '0';
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
        } else {
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
            'qr_code' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $qr_code = $request->qr_code;
        $employer_qr_code = Employer::where('id', $request->employer_id)->value('qr_code');
        if ($employer_qr_code) {
            if ($employer_qr_code == $qr_code) {
                $now = new \DateTime();
                $attendance = new Attendance();
                $attendance->user_id = Auth::user()->id;
                $attendance->employer_id = $request->employer_id;
                $attendance->approve_reject = '1';
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
            } else {
                return response()->json([
                    'message' => "Not Verified the Qr Code"
                ], 200);
            }
        } else {
            return response()->json([
                'message' => "Not Verified the Qr Code"
            ], 200);
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

        $qr_code = $request->qr_code;
        $employer_qr_code = Employer::where('id', $request->employer_id)->value('qr_code');
        if ($employer_qr_code) {
            if ($employer_qr_code == $qr_code) {
                $now = new \DateTime();
                $date = date('Y-m-d');
                $user_id = Auth::user()->id;
                $attendance =  Attendance::where('user_id', $user_id)->latest()->first();
                if ($attendance) {
                    // $check_in=$attendance->check_in;
                    // $total_time=$now - $check_in;
                    $attendance->check_out = $now;
                    $attendance->date = $now;
                    $attendance->employer_id = $request->employer_id;
                    $attendance->approve_reject = '0';
                    $attendance->status = '1'; // need to do the status check 
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
                } else {
                    return response()->json([
                        'message' => "user doesn't  checked out"
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
                        'message' => "Failed to check Out"
                    ], 400);
                }
            } else {
                return response()->json([
                    'message' => "Not Verified the Qr Code"
                ], 200);
            }
        } else {
            return response()->json([
                'message' => "Not Verified the Qr Code"
            ], 200);
        }
    }


    public function attendance(Request $request)
    {
        $now = new \DateTime();
        $user = Auth::user();
        $employer_id = $user->employer_id;
        $year = date("Y");
        $user_id = Auth::user()->id;
        $history = [];
        $history = Attendance::where('user_id', $user_id)
            ->whereYear('created_at', '=', $year)->get();
        $check_in_time = Employer::select('check_in_time')->where('id', $employer_id)->value('check_in_time');
        $check_out_time = Employer::select('check_out_time')->where('id', $employer_id)->value('check_out_time');
        $ontime = Attendance::where('user_id', $user_id)->whereYear('date', Carbon::today()->format('Y'))
                            ->whereTime('check_in', '<=', $check_in_time)->count();
        $late = Attendance::where('user_id', $user_id)->whereYear('date', Carbon::today()->format('Y'))
                            ->whereTime('check_in', '>', $check_in_time)->count(); 
        $earlyout = Attendance::where('user_id', $user_id)->whereYear('date', Carbon::today()->format('Y'))
                            ->whereTime('check_out', '<', $check_out_time)->count(); 
        $leaves = LeaveRequest::where('user_id', $user_id)->where('status', 1)->count();

        return response()->json([
            'message' => "Attendence Details Listed Below",
            'history' => $history,
            'ontime' => $ontime,
            'late' => $late,
            'earlyout' => $earlyout,
            'leaves' => $leaves,
        ], 200);
    }


    public function check_in_check_out_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'date' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $year = date("Y");
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $employer_id = $user->employer_id;

        $roster = Roster::where('user_id', $user_id)->where('start_date', '<=', Carbon::today())
                                ->where('end_date', '>=', Carbon::today())->get();

        $pending_attendance = Attendance::where('user_id', $user_id)->whereNull('approve_reject')->get();
        if(!$roster->isEmpty()){
            $check_in_time = Roster::where('user_id', $user_id)->value('start_time');    
        }else{
            $check_in_time = Employer::select('check_in_time')->where('id', $request->employer_id)->value('check_in_time');    
        }
        
        $history = [];
        $history = Attendance::with('user.branch:id,name')->where('employer_id', $request->employer_id)
                                ->whereDate('date', $request->date)->get();
        $present = Attendance::where('employer_id', $request->employer_id)->whereNotNull('check_in')
                                ->whereDate('date', $request->date)->count();
        // $absent = Attendance::where('employer_id', $request->employer_id)->whereNull('check_in')
        //                      ->whereDate('date', $request->date)->count();
        // $absent = LeaveRequest::where('employer_id', $request->employer_id)->where('status', 1)
        //                         ->whereBetween('start_date','end_date', $request->date)->count();
        $late = Attendance::where('employer_id', $request->employer_id)->whereDate('date', $request->date)
                                ->whereTime('check_in', '>', $check_in_time)->count();
        $total_count = User::where('employer_id', $request->employer_id)->count();
        $absent = $total_count - $present;
        return response()->json([
            'message' => "Checkin- Checkout  Details Listed Below",
            'history' => $history,
            'present' => $present,
            'absent' => $absent,
            'late' => $late,
            'total_count' => $total_count,
            'pending_attendance' => $pending_attendance,
        ], 200);
    }
}
