<?php

namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use App\Models\PaymentAdvance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentAdvanceController extends Controller
{
    //

    public function request_advance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' =>  'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $payRequest = new PaymentAdvance();
            $payRequest->user_id = Auth::user()->id;
            $payRequest->advance_amount = $request->amount;
            $payRequest->description = $request->description;

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


    

}
