<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BSPPaymentController extends Controller
{
    //

    public function processPayment()
    {
        
        $gatewayUrl = 'https://uat2.yalamanchili.in/MPI_v1/mercpg';
        
        // Set the parameters required by the payment gateway
        $params = [
            'nar_msgType' => 'AR',
            'nar_merTxnTime' => date('YmdHis'),
            'nar_merBankCode' => '01',
            //'nar_orderNo' => '',
            // Add all the necessary parameters here
        ];
 
        // Send a POST request to the gateway URL
        $response = Http::post($gatewayUrl, $params);
 
        // Handle the response, which may include redirection to the test interface
        // You may need to extract the returned HTML or URL for redirection
        return $response;
    }

    public function sendPaymentRequest(Request $request)
    {
       // dd($request);
        $sourceString = join('|', [
            'nar_cardType' => 'EX',
            'nar_merBankCode' => '01',
            'nar_merId' => $request->nar_merId,
            'nar_merTxnTime' => $request->nar_merTxnTime,//'20161031152438',
            'nar_msgType' => $request->nar_msgType,
            'nar_orderNo' => $request->nar_orderNo,
            'nar_paymentDesc' => 'Sampleproductdescription',
            'nar_remitterEmail' => $request->nar_remitterEmail,//'customermail@gmail.com',
            'nar_remitterMobile' => $request->nar_remitterMobile,//'12323213',
            'nar_txnAmount' => $request->nar_txnAmount,//'1.00',
            'nar_txnCurrency' => '242',
            'nar_version' => '1.0',
            'nar_returnUrl' => $request->nar_returnUrl,//'https://uat2.yalamanchili.in/pgsim/checkresponse',
        ]);

        // Retrieve private key and passphrase from config
        $binarySignature ="";
        $privateKeyPath = env('MERCHANT_PRIVATE_KEY');
        //$privateKey = env('BSP_PRIVATE_KEY');
        $passphrase = env('MERCHANT_PRIVATE_KEY_PASSPHRASE');
        

        $fp = fopen($privateKeyPath, 'r');
        $privKey = fread($fp, 8192);
        fclose($fp);

        //dd($passphrase);
        $res = openssl_get_privatekey($privKey, $passphrase);
        //$res = openssl_get_privatekey($privateKey, $passphrase);
       // dd($res);
       openssl_sign($sourceString, $binarySignature, $res, OPENSSL_ALGO_SHA1);
       //openssl_sign($sourceString, $binarySignature, $res);
        openssl_free_key($res);

        // Convert the binary signature to a hexadecimal string
        $checksum = bin2hex($binarySignature);

        // Now, send the request to BSP with the checksum
        $response = Http::post(config('app.BSP_API_URL'), [
            'data' => $data,
            'checksum' => $checksum,
        ]);


}

public function handleResponse(Request $request)
    {
        // Get the NVP response data from the request
        $nvpResponse = $request->all();

        // Verify the checksum using the public key
        $publicKeyPath = '/path/to/your/narada_secure_public_key.pem';
        $checksum = $nvpResponse['nar_checkSum']; // Get the checksum from the response

        // Construct the source string from the NVP response data
        $sourceString = join('|', $nvpResponse);

        // Verify the source string with the public key
        $publicKey = file_get_contents($publicKeyPath);
        $isValid = openssl_verify($sourceString, hex2bin($checksum), $publicKey, OPENSSL_ALGO_SHA1);

        if ($isValid === 1) {
            // Response is valid, process it
            // You can update your database or perform other actions based on the response
            // The response code and other details can be found in $nvpResponse
            // For example: $nvpResponse['nar_debitAuthCode'], $nvpResponse['nar_remarks'], etc.
        } else {
            // Response is not valid, handle the error or invalid response
        }

        // Return a response to NARADA® Secure if necessary (e.g., an acknowledgment)
    }
    
}
