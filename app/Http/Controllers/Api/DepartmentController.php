<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function get_department(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' =>  'required',
        ]);

          // if validation fails
          if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $department = Department::where('branch_id', $request->branch_id)->get();
        if ($department) {
            return response()->json([
                'message' => "Departments Listed Below",
                'departments' => $department,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Departments found. Please check business is created or not"
            ], 200);
        }
    }
}
