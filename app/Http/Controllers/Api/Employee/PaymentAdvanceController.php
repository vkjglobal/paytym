<?php

namespace App\Http\Controllers\Api\Employee;
use App\Http\Controllers\Controller;
use App\Models\PaymentAdvance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
            $now = Carbon::now();
            $payRequest = new PaymentAdvance();
            $payRequest->user_id = Auth::user()->id;
            $payRequest->employer_id = Auth::user()->employer_id;
            $payRequest->advance_amount = $request->amount;
            $payRequest->description = $request->description;
            $payRequest->requested_date = $now;

            $res = $payRequest->save();

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

    }


    

}
