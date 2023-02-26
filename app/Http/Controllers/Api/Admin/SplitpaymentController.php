<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SplitPayment;
use Illuminate\Http\Request;
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
                'message' => "Addedd To wallet Successfully",
                'splitpayment' =>  $splitpayment,
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went Wrong"
            ], 200);
        }
    }
}
