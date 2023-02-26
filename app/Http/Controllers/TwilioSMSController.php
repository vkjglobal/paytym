<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Exception;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;
  
class TwilioSMSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $receiverNumber = "+91 8893670517";
        $message = "This is testing";
  
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    public function sms_send_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' =>  'required',
            'receiver_number' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }


        $receiverNumber = $request->receiver_number;
        $message = $request->message;
  
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
                return response()->json([
                    'message' => "Sms Send Successfully",
                  
                ], 200);
  
        } catch (Exception $e) {
            return response()->json([
                'message' => "Something went wrong",
            ], 200);
        }
    }

}