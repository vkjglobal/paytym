<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Employee\AuthController;
use Illuminate\Support\Facades\Validator;
use App\Mail\CommonRequestEmailstoHR;
use Mail;

class OverTimeController extends Controller
{
    //
    public function list_overtime(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'employer_id' =>  'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => $validator->errors()->first()
        //     ], 400);
        // }

        if (isset($request->employer_id)) {
            $employer_id = $request->employer_id;
            $overtime_requests = Overtime::with('user.branch')->orderBy('id', 'desc')->where('employer_id', $employer_id)->get();
        } else {
            $employee_id = $request->employee_id;
            $overtime_requests = Overtime::with('user.branch')->orderBy('id', 'desc')->where('employee_id', $employee_id)->get();
        }


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
            if ($status == '1') {
                $message = "Your request is Approved.";
            } else {
                $message = "Sorry, Your request is Rejected.";
            }

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
                $overtime->decline_reason = optional($request)->decline_reason;
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
                $overtime->status = '1';
            } else {
                return response()->json([
                    'message' => "No Records Found"
                ], 200);
            }
        }
        // $overtime->status ='1';
        $issave = $overtime->save();
        if ($issave) {
            if ($status == '1' || $status == '2') {
                $otherController = new AuthController();
                $result = $otherController->push_notification($request, $request->employee_id, $message);
            }
            return response()->json([
                'message' => "Action executed Successfully"

            ], 200);
        } else {
            return response()->json([
                'message' => "Something Went wrong"
            ], 200);
        }
    }

    public function hr_store_overtime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'employee_id' => 'required',
            'date' => 'required',
            'total_hours' => 'required',
            'reason' => 'required'
        ]);
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
        $overtime->status = '1';
        $issave = $overtime->save();

        $user = User::where('id', $request->employee_id)->first();
        $hr = User::join('roles', 'users.position', '=', 'roles.id')
        ->where('users.employer_id', $request->employer_id)
        ->where('users.status', 1)
        ->where('roles.role_name', 'like', '%HR%')
        ->get();
        $emails = $hr->pluck('email');
                $recipients = $emails->toArray();
                if ($emails->count()>0) {
                    $content = 'An overtime request is received from ' . $user->first_name .' on ' . $request->date . 'for' .$request->total_hours . 'hours.Please Approve/Reject.';
                    $title = 'New Overtime Request Notification';
                    $subject = 'New Overtime Request from ' .$user->first_name ;
                    Mail::to($recipients)->send(new CommonRequestEmailstoHR($user,$content,$subject,$title));
                    } 

        if ($issave) {
            return response()->json([
                'message' => "Overtime added Successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong"
            ], 400);
        }
    }
}
