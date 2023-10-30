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
        //dd($request);
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
            'nar_returnUrl' => 'https://uat2.yalamanchili.in/pgsim/checkresponse',
        ]);
        //dd($sourceString);

        // Retrieve private key and passphrase from config
        $binary_signature ="";
        $privateKeyPath = env('MERCHANT_PRIVATE_KEY');
        $passphrase = env('MERCHANT_PRIVATE_KEY_PASSPHRASE');
        $fp = fopen($privateKeyPath, 'r');
        $privKey = fread($fp, 8192);
        fclose($fp);

        //dd($privKey);
        $res = openssl_get_privatekey($privKey);
        //$res = openssl_get_privatekey($privateKey, $passphrase);
       openssl_sign($sourceString, $binary_signature, $res, OPENSSL_ALGO_SHA1);
       //dd(openssl_sign($sourceString, $binarySignature, $res, OPENSSL_ALGO_SHA1));
        openssl_free_key($res);
        echo "Generate CheckSUM: ";
        var_dump(bin2hex($binary_signature)); //Convert Binary Signature Value to HEX
//dd(bin2hex($binary_signature));


        
        session(['binary_signature' => bin2hex($binary_signature)]);
        //dd($binary_signature);
        // Convert the binary signature to a hexadecimal string
        $checksum = bin2hex($binary_signature);

        // Now, send the request to BSP with the checksum
        $response = Http::post(env('BSP_API_URL'), [
            'data' => $sourceString,
            'checksum' => $checksum,
        ]);


}

public function handleResponse(Request $request)
    {
        //dd($request);
        $publicKeyPath = env('BSP_PUBLIC_KEY');
        $fpq=fopen ($publicKeyPath,"r");
        $pub_key=fread($fpq,8192); 
        fclose($fpq);
        $pubs = openssl_get_publickey($pub_key);
        $ok = openssl_verify($data, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
        echo "check #1: Verification "; 
        if ($ok == 1) {
        echo "signature ok (as it should be)\n";
        } elseif ($ok == 0) {
        echo "bad (there's something wrong)\n";
        } else {
        echo "ugly, error checking signature\n";
        }
        // Get the NVP response data from the request
       // $nvpResponse = $request->all();
        // Verify the checksum using the public key
        //$publicKeyPath = 'C:\Users\Neena-PC\Desktop\876500008765001.ipg.yalamanchili.in-key-public.pem';//'/path/to/your/narada_secure_public_key.pem';
       // $checksum = $nvpResponse['nar_checkSum']; // Get the checksum from the response

        // Construct the source string from the NVP response data
        //$sourceString = join('|', $nvpResponse);

        // Verify the source string with the public key
        //$publicKey = file_get_contents($publicKeyPath);
        //$isValid = openssl_verify($sourceString, hex2bin($checksum), $publicKey, OPENSSL_ALGO_SHA1);
        /* dd($isValid);
        if ($isValid === 1) {
            // Response is valid, process it
            // You can update your database or perform other actions based on the response
            // The response code and other details can be found in $nvpResponse
            // For example: $nvpResponse['nar_debitAuthCode'], $nvpResponse['nar_remarks'], etc.
        } else {
            // Response is not valid, handle the error or invalid response
        } */

        // Return a response to NARADA® Secure if necessary (e.g., an acknowledgment)
    }
    
}
