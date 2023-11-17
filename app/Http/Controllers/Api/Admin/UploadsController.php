<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileType;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadsController extends Controller
{
    public function list_file_types(Request $request)
    {
        $file_types = FileType::get();
        if ($file_types) {
            return response()->json([
                'message' => "Action Executed Successfully",
                'file_types' => $file_types
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records Found"
            ], 200);
        }
    }

    public function list_employee_file_types(Request $request)
    {
        $file_types = FileType::where('visible_status', '0')->get();
        if ($file_types) {
            return response()->json([
                'message' => "Action Executed Successfully",
                'file_types' => $file_types
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records Found"
            ], 200);
        }
    }

    public function upload_files(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $status = $request->status;   // 0->upload 1->delete 
        if ($status == '0') {
            $validator = Validator::make($request->all(), [
                'employer_id' =>  'required',
                'file_type_id' =>  'required',
                'user_id' =>  'required',
                'file' =>  'required',
                'status' => 'required'

            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }
            //  dd($request->all());
            $uploads = new Upload();
            $uploads->employer_id = $request->employer_id;
            $uploads->file_type_id = $request->file_type_id;
            $uploads->user_id = $request->user_id;
            //Rj work 19-10-23
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName(); // Get the original file name
            $file_path = $file->storeAs('public/file', $originalFileName);
            //         $file_path = $request->file('file')->store('file', 'public');
            $uploads->file = $file_path;

            // // Upload Files

            // // Get the uploaded file
            // $file = $request->file('file');

            // // Generate a unique filename for the image
            // $originalFileName = $file->getClientOriginalName();

            // //dd($originalFileName);
            // // Define the storage path for the image
            // $storagePath = 'public/uploads/file';


            // // Move the uploaded file to the storage location
            // $file->move(storage_path($storagePath), $originalFileName);
            // $uploads->file = 'uploads/file/' . $originalFileName;



            // End Upload Files

            $issave = $uploads->save();
            if ($issave) {
                return response()->json([
                    'message' => "Action executed Successfully",
                    'uploaded files' => $uploads
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something Went wrong"
                ], 200);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'id' =>  'required',
            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $upload_delete = Upload::where('id', $request->id)->delete();
            if ($upload_delete) {
                return response()->json([
                    'message' => "Deleted Successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something went Wrong"
                ], 200);
            }
        }
    }

    public function employee_upload_files(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' =>  'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $status = $request->status;   // 0->upload 1->delete 
        if ($status == '0') {
            $validator = Validator::make($request->all(), [
                'employer_id' =>  'required',
                'file_type_id' =>  'required',
                'user_id' =>  'required',
                'file' =>  'required',
                'status' => 'required'

            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }
            $uploads = new Upload();
            $uploads->employer_id = $request->employer_id;
            $uploads->file_type_id = $request->file_type_id;
            $uploads->user_id = $request->user_id;
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName(); // Get the original file name
            $file_path = $file->storeAs('public/employee_uploaded_file', $originalFileName);
            //    $file_path = $request->file('file')->store('employee_uploaded_file', 'public');
            $uploads->file = $file_path;
            $issave = $uploads->save();
            if ($issave) {
                return response()->json([
                    'message' => "Action executed Successfully",
                    'uploaded files' => $uploads
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something Went wrong"
                ], 200);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'id' =>  'required',
            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $upload_delete = Upload::where('id', $request->id)->delete();
            if ($upload_delete) {
                return response()->json([
                    'message' => "Deleted Successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something went Wrong"
                ], 200);
            }
        }
    }



    public function list_files(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' =>  'required',   // 0->employee only,1->for HR 
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $status = $request->status; // 0 => Employee,  1 => Hr
        if ($status == '0') {
            $validator = Validator::make($request->all(), [
                'employee_id' =>  'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $files = Upload::with('filetype')->where('user_id', $request->employee_id)->get();
        } else {
            $validator = Validator::make($request->all(), [
                'employer_id' =>  'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }
            $files = Upload::with('filetype')->where('employer_id', $request->employer_id)->get();
        }

        if ($files) {
            return response()->json([
                'message' => "files listed Successfully",
                'files' => $files,
            ], 200);
        } else {
            return response()->json([
                'message' => "No records"
            ], 400);
        }
    }
}
