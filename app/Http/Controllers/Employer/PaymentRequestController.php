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

    public function payslip()
    {
        $user=Auth::user();

        $payroll=Payroll::where('user_id',$user->id)->orderBy('id', 'DESC')->first();
        if($payroll)
        {
            return response()->json([
                'message' => "Success",
                "payroll"=>$payroll,
            ], 200);
        }
        else{
            return response()->json([
                'message' => "No Records"
            ], 400);
        }


    }


}
