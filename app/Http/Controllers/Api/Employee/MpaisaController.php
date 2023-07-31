<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MpaisaController extends Controller
{
    public function send_req()
    {
        $transactionID=100037;
        $amount=1;
        $url = 'http://127.0.0.1:8000';
        $client_id = 20191;
        $itemdetails='Hello';
        $merchantsecret='D7EC20B1B80385587ED65B55D80F50D6';
        // $responseCode='200';
        // $hash = hash('sha256', $transactionID.$amount.$itemdetails.$merchantsecret.$responseCode);
        // $ans = Hash::check('CC206F84413B18B61BC1491D4C93E9D682C2D86F5813C8EAC3776BF649630BD4', $hash);

        $res = Http::get('https://pay.mpaisa.vodafone.com.fj/API', [
                'url' => $url,
                'tID' => $transactionID,
                'amt' => $amount,
                'cID' => $client_id,
                'iDet' => $itemdetails,
        ]);
        $body = $res->getBody()->getContents();
        $data = json_decode($body);
        $destinationurl = $data->destinationurl;   
        $requestID = $data->requestID;   
        $response = $data->response;   
        $tokenv2 = $data->tokenv2;  
        
        return redirect($destinationurl);
        
        // $res = Http::get($destinationurl, [
        //     'url' => $url,
        //     'tID' => $transactionID,
        //     'amt' => $amount,
        //     'cID' => $client_id,
        //     'iDet' => $itemdetails,
        //     'rID' => $requestID,
        // ]);
        // $body = $res->getBody()->getContents();
        // $data = json_decode($body);

        // $client = new Client(); 
        // $res = $client->request('get', 'https://pay.mpaisa.vodafone.com.fj/API', [
        //     'form_params' => [
        //         'url' => $url,
        //         'tID' => $transactionID,
        //         'amt' => $amount,
        //         'cID' => $client_id,
        //         'iDet' => $itemdetails,
        //     ]
        // ]);
        
        // if ($res->getStatusCode() == 200) { // 200 OK
        //     $response_data = $res->getBody()->getContents();
        // }

        // if ($data) {
        //     return response()->json([
        //         'message' => "Success",
        //         'data' => $data,
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'message' => "No Records"
        //     ], 400);
        // }
    }
}
