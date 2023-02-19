<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    //

    public function list_branch_departments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $branches = [];
        $departments = [];
        $branches = Branch::where('employer_id', $request->employer_id)->get();
        $departments = Department::where('employer_id', $request->employer_id)->get();

        return response()->json([
            'message' => "Listed Successfully",
            'branches' =>  $branches,
            'departments' =>  $departments,
        ], 200);
    }
}
