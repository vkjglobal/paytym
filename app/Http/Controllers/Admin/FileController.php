<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{


public function upload_files(Request $request)
{
    $validator = Validator::make($request->all(), [
        'employer_id' =>  'required',
        'employee_id' =>  'required',
        'employer_id' =>  'required',
        'employee_id' =>  'required',
    ]);

    // if validation fails
    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors()->first()
        ], 400);
    }




}


}
