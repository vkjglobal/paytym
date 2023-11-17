<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\AssignDeduction;
use App\Models\Deduction;
use App\Models\PaymentAdvance;
use App\Models\User;
use App\Mail\CommonRequestEmailstoHR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mail;


class PaymentAdvanceController extends Controller
{
    //request_advance
    public function advance_request_approve_decline_edit(Request $request)
    {
        // 08-11-23

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
                'amount' =>  'required',
                'date_of_requirement' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            } else {
                $now = Carbon::now();
                $requested_date = $request->date_of_requirement;
                $payRequest = new PaymentAdvance();
                $payRequest->user_id = Auth::user()->id;
                $payRequest->employer_id = Auth::user()->employer_id;
                $payRequest->advance_amount = $request->amount;
                $payRequest->description = $request->description;
                $payRequest->requested_date = $requested_date;

                $res = $payRequest->save();
                $user = User::where('id', Auth::user()->id)->first();
                $hr = User::join('roles', 'users.position', '=', 'roles.id')
                ->where('users.employer_id', Auth::user()->employer_id)
                ->where('users.status', 1)
                ->where('roles.role_name', 'like', '%HR%')
                ->get();
                $emails = $hr->pluck('email');
                $recipients = $emails->toArray();
                if ($emails->count()>0) {
                    $content = 'An advance amount of ' .$request->amount . ' is requested by ' . $user->first_name .' .Please Approve/Reject.';
                    $title = 'New Advance Request Notification';
                    $subject = 'New Advance Request from ' .$user->first_name ;
                    Mail::to($recipients)->send(new CommonRequestEmailstoHR($user,$content,$subject,$title));
                    } 

                if ($res) {
                    return response()->json([
                        'message' => "Success",
                        'payRequest' => $payRequest
                    ], 200);
                } else {
                    return response()->json([
                        'message' => "Fail"
                    ], 400);
                }
            }
        } elseif ($status == '1' || $status == '2') {
            $validator = Validator::make($request->all(), [
                'id' =>  'required',
    
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            } else {
                $id = $request->id;
                $status = $request->status;   //1 => Accepted 2=>Rejected  3=> Edit 
                $payment_advance = PaymentAdvance::where('id', $id)->first();
                if ($payment_advance) {
                    $payment_advance->status = $status;
                    if ($status == '1') {
                        $validator = Validator::make($request->all(), [
                            'id' =>  'required',
                            'employer_id' => 'required',
                            'amount' => 'required',
                            'user_id' => 'required'
                        ]);
                        
                        $deduction_details = Deduction::where('name', 'LIKE', '%Salary Advance%')->first();
                        if ($deduction_details) {
                        } else {
                            $deduction_details = new Deduction();
                            $deduction_details->employer_id = $request->employer_id;
                            $deduction_details->name = "Salary Advance";
                            $deduction_details->description = "Salary Advance";
                            $issave = $deduction_details->save();
                        }
                        $deduction = new AssignDeduction();
                        $deduction->employer_id = $request->employer_id;
                        $deduction->rate = $request->amount;
                        $deduction->deduction_id = $deduction_details->id;
                        $deduction->user_id = $request->user_id;
                        $issave = $deduction->save();
                        $msg = "Advance Request Accepted";
                    } else {
                        $payment_advance->decline_reason = $request->decline_reason;
                        $msg = "Advance Request Rejected";
                    }

                    $issave = $payment_advance->save();
                    if ($issave) {
                        if ($status == '1' || $status == '2') {
                            $otherController = new AuthController();
                            $result = $otherController->push_notification($request, $request->user_id, $msg);
                        }
                        return response()->json([
                            'message' => $msg
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Not Executed. Please check '
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'message' => "Something Went Wrong"
                    ], 200);
                }
            }
        } else {   // Edit

            $validator = Validator::make($request->all(), [
                'id' =>  'required',
                'amount' =>  'required',
                'date_of_requirement' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            } else {
                $id = $request->id;
                $payment_advance =  PaymentAdvance::where('id', $id)->first();
                if ($payment_advance) {
                    if (isset($request->requested_date)) {
                        $payment_advance->requested_date = $request->date_of_requirement;
                    }
                    if (isset($request->advance_amount)) {
                        $payment_advance->advance_amount = $request->amount;
                    }
                    if (isset($request->decline_reason)) {
                        $payment_advance->readecline_reasonson = $request->decline_reason;
                    }
                    $payment_advance->status = '1';
                } else {
                    return response()->json([
                        'message' => "No Records Found"
                    ], 200);
                }
            }
            // $overtime->status ='1';
            $issave = $payment_advance->save();
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

        // End 08-11-23
    }


    public function list_advance_request(Request $request)
    {
        if (isset($request->employer_id)) {
            $employer_id = $request->employer_id;
            $overtime_requests = PaymentAdvance::with('user')->orderBy('id', 'desc')->where('employer_id', $employer_id)->get();
        } else {
            $employee_id = $request->employee_id;
            $overtime_requests = PaymentAdvance::with('user')->orderBy('id', 'desc')->where('user_id', $employee_id)->get();
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
}
