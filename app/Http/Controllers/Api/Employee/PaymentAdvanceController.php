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

    public function request_advance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' =>  'required',
            'date_of_requirement' => 'required',
            'description'=>'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $now = Carbon::now();
            $requested_date=$request->date_of_requirement;
            $payRequest = new PaymentAdvance();
            $payRequest->user_id = Auth::user()->id;
            $payRequest->employer_id = Auth::user()->employer_id;
            $payRequest->advance_amount = $request->amount;
            $payRequest->description = $request->description;
            $payRequest->requested_date = $requested_date;

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


    public function list_advance_request(Request $request)
    {
        if(isset($request->employer_id))
        {
            $employer_id = $request->employer_id;
            $overtime_requests = PaymentAdvance::with('user')->orderBy('id', 'desc')->where('employer_id', $employer_id)->get();
        }
        else
        {
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
