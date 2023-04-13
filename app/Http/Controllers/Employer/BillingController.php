<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $plan = Subscription::find($request->plan_id);
        return view('employer.billing.index', compact('plan'));
    }
    
    public function plan()
    {
        $subscription = Subscription::where('status', '1')->get();
        $pricing = Cms::where('cms_type','like','%pricing%') -> first();
        return view('employer.payment.plan', compact('subscription', 'pricing'));
    }
    
    public function pay(Request $request)
    {
        $nar_msgType = $request->nar_msgType;
        $nar_merTxnTime = now()->format('YmdHis');
        $nar_merBankCode = $request->nar_merBankCode;
        $nar_orderNo = 'ORD_'.now()->format('YmdHis');
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

        $nar_checkSum = $nar_cardType.'|'.$nar_merBankCode.'|'.$nar_merId.'|'.$nar_merTxnTime.'|'.$nar_msgType.'|'.$nar_orderNo.'|'.
        $nar_paymentDesc.'|'.$nar_remitterEmail.'|'.$nar_remitterMobile.'|'.$nar_txnAmount.'|'.$nar_txnCurrency.'|'.
        $nar_version.'|'.$nar_returnUrl;

        // $signed_string = $this->checkSum($nar_checkSum);

        // $signed_string=Crypt::encryptString($nar_checkSum);

        // dd($signed_string);
        
        // return ($nar_merId);

        $response = Http::asForm()->post('https://uat2.yalamanchili.in/MPI_v1/sandboxtest', [
            'nar_msgType' => $nar_msgType,
            'nar_merTxnTime' => $nar_merTxnTime,
            'nar_merBankCode' => $nar_merBankCode,
            'nar_orderNo' => $nar_orderNo,
            'nar_merId' => $nar_merId,
            'nar_txnCurrency' => $nar_txnCurrency,
            'nar_txnAmount' => $nar_txnAmount,
            'nar_remitterEmail' => $nar_remitterEmail,
            'nar_remitterMobile' => $nar_remitterMobile,
            'nar_cardType' => $nar_cardType,
            'nar_paymentDesc' => $nar_paymentDesc,
            'nar_version' => $nar_version,
            'nar_mcccode' => $nar_mcccode,
            'nar_returnUrl' => 'http://127.0.0.1:8000/employer/billing/plan',
            'nar_Secure' => $nar_Secure,
            'nar_checkSum' => $nar_checkSum,
            // 'Referral_Url' => $request->Referral_Url,
        ]);
        return $response;

        if ($response->successful()){
            return view('employer.payment.success');
        }
        else{
            return view('employer.payment.failed');
        }
    }

    public function checkSum($data){
        // // Generate a new private key
        // $privateKey = openssl_pkey_new();
        // dd($privateKey);
        // // Extract the public key from the private key
        // $details = openssl_pkey_get_details($privateKey);
        // $publicKey = $details['key'];

        // // Encrypt the data using the public key
        // openssl_public_encrypt($data, $encryptedData, $publicKey);

        // // Base64 encode the encrypted data
        // $base64Data = base64_encode($encryptedData);

        // return ($base64Data);

        // return Http::post('https://uat2.yalamanchili.in/pgsim/GenCksum', [
        //     'nar_checkSum' => $data,
        // ]);
            $binary_signature = "";
            $fp=fopen("private.key","r");
            $priv_key=fread($fp,8192); fclose($fp);
            $passphrase="1234"; //this will be the passphrase used to sign the key
            $res = openssl_get_privatekey($priv_key,$passphrase); 
            openssl_sign($data, $binary_signature, $res, OPENSSL_ALGO_SHA1); 
            openssl_free_key($res);
            echo "Generate CheckSUM: ";
            var_dump(bin2hex($binary_signature)); //Convert Binary Signature Value to HEX
            }
}
