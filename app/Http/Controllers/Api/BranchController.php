<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function get_branch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_id' =>  'required',
        ]);



        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }




        $branches = Branch::where('employer_business_id', $request->business_id)->get();
        if ($branches) {
            return response()->json([
                'message' => "Branches Listed Below",
                'branches' => $branches,
            ], 200);
        } else {
            return response()->json([
                'message' => "No branches found. Please check business is created or not"
            ], 200);
        }
    }
}
