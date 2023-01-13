<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuitRequest;
use Illuminate\Support\Facades\Validator;
use Auth;

class QuitCompanyController extends Controller
{
    public function quit_request(Request $request){

        $validator = Validator::make($request->all(),[
            'requests' => 'required',
        ]);

        if($validator->fails()){
        return response()->json([
            'message'=> $validator->errors()->first()

        ],400);
        }else{
            $quit_request = new QuitRequest();
            $quit_request->employee_id = Auth::user()->id;
            $quit_request->employer_id = Auth::user()->employer_id;   
            $quit_request->requests = $request->requests;
            $res = $quit_request->save();

            if($res) {
                return response()->json([
                    'message'=> 'success',

                ],200);
            }else{
                return response()->json([
                    'message'=> 'fail'
                ],400);
            }
        
    }
    }
}
