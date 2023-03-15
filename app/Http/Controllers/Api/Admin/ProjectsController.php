<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    //
    public function list_projects(Request $request)
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

        $projects = Project::
        with(['branch:id,name','employeeproject.user:id,first_name,last_name,image,branch_id','employeeproject.user.branch:id,name'])
        ->where('employer_id', $request->employer_id)->get();


        if ($projects) {
            return response()->json([
                'message' => "Success",
                'projects lists' => $projects,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records",

            ], 200);
        }
    }


    public function project_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $projects = EmployeeProject::with('user')->where('id', $request->project_id)->first();

        if ($projects) {
            return response()->json([
                'message' => "Success",
                'projects liste' => $projects,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records",
            ], 200);
        }
    }
}
