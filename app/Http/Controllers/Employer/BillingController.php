<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class BillingController extends Controller
{
    public function index()
    {
        // return('ORD_'.now()->format('YmdHis'));
        return view('employer.billing.index');
    }
    
    public function plan()
    {
        $subscription = Subscription::where('status', '1')->get();
        $pricing = Cms::where('cms_type','like','%pricing%') -> first();
        return view('employer.billing.plan', compact('subscription', 'pricing'));
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

        
        // return ($nar_merId);

        return Http::asForm()->post('https://uat2.yalamanchili.in/MPI_v1/sandboxtest', [
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
            'nar_returnUrl' => $nar_returnUrl,
            'nar_Secure' => $nar_Secure,
            'nar_checkSum' => $nar_checkSum,
            // 'Referral_Url' => $request->Referral_Url,
        ]);
    }

    public function checkSum(){
        $nar_merTxnTime = now()->format('YmdHis');
    }
}