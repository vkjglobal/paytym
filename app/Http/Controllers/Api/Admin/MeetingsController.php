<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends Controller
{
    public function list_meetings(Request $request)
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
        $meetings = Meeting::where('employer_id', $request->employer_id)->get();
        if ($meetings) {
            return response()->json([
                'message' => "Success",
                'meetings liste' => $meetings,
            ], 200);
        } else {

            return response()->json([
                'message' => "No Records found"
            ], 200);
        }
    }

    //
    public function create_meetings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'date' =>  'required',
            'start_time' =>  'required',
            'end_time' => 'required',
            'location' => 'required',
            'name' => 'required',

        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $meetings = new Meeting();
        $meetings->user_id = Auth::user()->id;
        $meetings->employer_id = $request->employer_id;
        $meetings->date = $request->date;
        $meetings->start_time = $request->start_time;
        $meetings->end_time = $request->end_time;
        $meetings->name = $request->name;
        $meetings->location = $request->location;

        $issave = $meetings->save();
        if ($issave) {
            return response()->json([
                'message' => "Success",
                'chats' => $meetings,
            ], 200);
            //     foreach ($request->members as $member) {
            //         echo $member['name'];
            //  }
        }
    }


    public function meetings_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' =>  'required',

        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $id = $request->id;
        $deduction = Meeting::where('id', $id)->delete();
        if ($deduction) {
            return response()->json([
                'message' => "Deleted Successfully"
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records"
            ], 200);
        }
    }


}
