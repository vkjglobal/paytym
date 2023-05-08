<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SplitPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SplitpaymentController extends Controller
{
    //
    public function split_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'employee_id' => 'required',
            'payment_wallet' => 'required',
            'amount' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $splitpayment = new SplitPayment();
        $splitpayment->employer_id = $request->employer_id;
        $splitpayment->employee_id = $request->employee_id;
        $splitpayment->payment_wallet = $request->payment_wallet;
        $splitpayment->amount = $request->amount;
        $issave = $splitpayment->save();

        if ($issave) {
            return response()->json([
                'message' => "Added Successfully",
                'splitpayment' =>  $splitpayment,
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong"
            ], 200);
        }
    }
    public function split_payment_list(Request $request)
    {
        $user = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
       
        // $split_payment_list = SplitPayment::where('employer_id', $request->employer_id)->where('employee_id', $user)->get();
        $mycash = SplitPayment::where('employer_id', $request->employer_id)->where('employee_id', $user)->where('payment_wallet', '0')->orderBy('id', 'desc')->first();
        $mpaisa = SplitPayment::where('employer_id', $request->employer_id)->where('employee_id', $user)->where('payment_wallet', '1')->orderBy('id', 'desc')->first();
        $bank = SplitPayment::where('employer_id', $request->employer_id)->where('employee_id', $user)->where('payment_wallet', '2')->orderBy('id', 'desc')->first();
        if ($mycash || $mpaisa || $bank) {
            return response()->json([
                'message' => "Success",
                // 'split_payment_list'=>$split_payment_list,
                'mycash'=>$mycash,
                'mpaisa'=>$mpaisa,
                'bank'=>$bank,
            ], 200);
        } else {
            return response()->json([
                'message' => "Fail"
            ], 200);
        }
    }
}
