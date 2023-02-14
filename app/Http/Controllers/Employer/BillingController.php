<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BillingController extends Controller
{
    public function pay(Request $request)
    {
        // dd($request);
        // Collect form data from the request
     
        $nar_msgType = $request->nar_msgType;
        $nar_merTxnTime = $request->nar_merTxnTime;
        $nar_merBankCode = $request->nar_merBankCode;
        $nar_orderNo = $request->nar_orderNo;
        $nar_merId = $request->nar_merId;
        $nar_txnCurrency = $request->nar_txnCurrency;
        $nar_txnAmount = $request->nar_txnAmount;
        $nar_remitterEmail = $request->nar_remitterEmail;
        $nar_remitterMobile = $request->nar_remitterMobile;
        $nar_cardType = $request->nar_cardType;
        $nar_paymentDesc = $request->nar_paymentDesc;
        $nar_version = $request->nar_version;
        $nar_mcccode = $request->nar_mcccode;
        $nar_returnUrl = $request->nar_returnUrl;
        $nar_Secure = $request->nar_Secure;


        // Build the payment request data
        $data = [

    'nar_msgType' => $request-> nar_msgType,
    'nar_merTxnTime' => $request-> nar_merTxnTime,
    'nar_merBankCode' => $request-> nar_merBankCode,
    'nar_orderNo' => $request-> nar_orderNo,
    'nar_merId' => $request-> nar_merId,
    'nar_txnCurrency' => $request-> nar_txnCurrency,
    'nar_txnAmount' => $request-> nar_txnAmount,
    'nar_remitterEmail' => $request-> nar_remitterEmail,
    'nar_remitterMobile' => $request-> nar_remitterMobile,
    'nar_cardType' => $request-> nar_cardType,
    'nar_paymentDesc' => $request-> nar_paymentDesc,
    'nar_version' => $request-> nar_version,
    'nar_mcccode' => $request-> nar_mcccode,
    'nar_returnUrl' => $request-> nar_returnUrl,
    'nar_Secure' => $request-> nar_Secure
     ];
            // Add any other required fields for the payment gateway

        // Send the payment request to the payment gateway's API
        $client = new Client();
        $response = $client->post('https://uat2.yalamanchili.in/MPI_v1/sandboxtest', [
            // 'headers' => [
            //     'Authorization' => 'Bearer ' . env('PAYMENT_GATEWAY_API_KEY'),
            //     'Content-Type' => 'application/json',
            // ],
            'json' => $data,
        ]);

        // Handle the response from the payment gateway
        if ($response->getStatusCode() == 200) {
            dd($response);
        } 
    }

        // else {
            // Payment failed
            // Update the user's order status
            // Redirect the user to an error page
    //     }
    // }

    // public function callback(Request $request)
    // {
        // Handle the return callback from the payment gateway
        // Update the user's order status accordingly
//     }
// }
}
