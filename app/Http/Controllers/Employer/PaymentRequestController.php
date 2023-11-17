<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentRequestController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' =>  'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $payRequest = new PaymentRequest();
            $payRequest->user_id = Auth::user()->id;
            $payRequest->date = date('Y-m-d');
            $payRequest->amount = $request->amount;

            $res = $payRequest->save();

            if ($res) {
                return response()->json([
                    'message' => "Success",
                ], 200);
            } else {
                return response()->json([
                    'message' => "Fail"
                ], 400);
            }
        }
    }

    public function payslip(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'year' =>  'required',
            'month' =>  'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            // $payroll = Payroll::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
            $payroll = Payroll::whereYear('created_at', $request->year)->whereMonth('created_at', $request->month)
                                ->where('user_id', $user->id)->orderBy('id', 'DESC')->get();

            if ($payroll) {
                return response()->json([
                    'message' => "Success",
                    "payroll" => $payroll,
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Records"
                ], 400);
            }
        }
    }


    public function payslip_all(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' =>  'required',
            'month' =>  'required',
            'employer_id' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $employer_id=$request->employer_id;
            // $payroll = Payroll::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
            $payroll = Payroll::whereYear('created_at', $request->year)->whereMonth('created_at', $request->month)
                                ->where('employer_id',$employer_id)->orderBy('id', 'DESC')->get();

            if ($payroll) {
                return response()->json([
                    'message' => "Success",
                    "payroll" => $payroll,
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Records"
                ], 400);
            }
        }
    }


    public function request_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' =>  'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $payment_request = new PaymentRequest();
            $payment_request->user_id = Auth::user()->id;
            $payment_request->amount = $request->amount;
            $payment_request->date = new \DateTime();

            $res = $payment_request->save();

            if ($res) {
                return response()->json([
                    'message' => "Payment Requested Successfully",
                ], 200);
            } else {
                return response()->json([
                    'message' => "Fail"
                ], 400);
            }
        }
    }
}
