<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        //dd($request->all());
        //echo "Generate CheckSUM: " . $request->nar_checkSum;
         $sourceString = join('|', [
            'nar_cardType' => 'EX',
            'nar_merBankCode' => '01',
            'nar_merId' => $request->nar_merId,
            'nar_merTxnTime' => $request->nar_merTxnTime,//'20161031152438',
            'nar_msgType' => $request->nar_msgType,
            'nar_orderNo' => $request->nar_orderNo,
            'nar_paymentDesc' => $request->nar_paymentDesc,
            'nar_remitterEmail' => $request->nar_remitterEmail,//'customermail@gmail.com',
            'nar_remitterMobile' => $request->nar_remitterMobile,//'12323213',
            'nar_txnAmount' => $request->nar_txnAmount,//'1.00',
            'nar_txnCurrency' => '242',
            'nar_version' => '1.0',
            'nar_returnUrl' => $request->nar_returnUrl,
        ]);
        Log::info('Source String: ' . $sourceString);
       //dd($sourceString);

        // Retrieve private key and passphrase from config
        $binary_signature =$request->bs;
        //dd($binary_signature);
        /* $privateKeyPath = env('MERCHANT_PRIVATE_KEY');
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

        Log::info('Source String: ' . $sourceString);
        Log::info('Binary Signature: ' . bin2hex($binary_signature)); */

        // Now, send the request to BSP with the checksum
     /*    $response = Http::withOptions(['timeout' => 30])->post(env('BSP_API_URL'), [ //Http::post(env('BSP_API_URL'), [
            'data' => $sourceString,
            'checksum' => $checksum,
        ]); */
        
        $attempts = 3;
$retryDelay = 5; // Delay in seconds between retries

for ($i = 1; $i <= $attempts; $i++) {
    try {
        $response = Http::withOptions(['timeout' => 10])->post(env('BSP_API_URL'), [
            'data' => $sourceString,
            'checksum' => $checksum,
        ]);
        // Check if the response was successful
        if ($response->successful()) {
            // Handle the response
            break; // Exit the loop if successful
        }
    } catch (\Exception $e) {
        // Handle the exception (e.g., log the error)
    }
    
    if ($i < $attempts) {
        sleep($retryDelay); // Wait before the next retry
    }
    
       
    //dd($request);
    $publicKeyPath = env('BSP_PUBLIC_KEY');
    $fpq=fopen ($publicKeyPath,"r");
    $pub_key=fread($fpq,8192); 
    fclose($fpq);
    //dd($pub_key);

    $pubs = openssl_get_publickey($pub_key);
    //dd($pubs);
   // $ok = openssl_verify($data, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
    $ok = openssl_verify($sourceString, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
    //dd($ok);
    //session(['okvalue' => $ok]);
    Log::info('Response Data: ' . json_encode($request->all()));
    Log::info('Checksum Verification Result: ' . $ok);  
    echo "check #1: Verification "; 
    if ($ok == 1) {
    echo "signature ok (as it should be)\n";
    } elseif ($ok == 0) {
    echo "bad (there's something wrong)\n";
    //return redirect()->route('employer.home');
    } else {
    echo "ugly, error checking signature\n";
    }
   
}



}

public function handleResponse(Request $request)
    {
        //dd($request);
        $publicKeyPath = env('BSP_PUBLIC_KEY');
        $fpq=fopen ($publicKeyPath,"r");
        $pub_key=fread($fpq,8192); 
        fclose($fpq);
        $pubs = openssl_get_publickey($pub_key);
        //$ok = openssl_verify($data, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
        $ok = openssl_verify($data, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
        Log::info('Response Data: ' . json_encode($request->all()));
        Log::info('Checksum Verification Result: ' . $ok);  
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
