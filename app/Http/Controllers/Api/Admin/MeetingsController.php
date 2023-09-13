<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingAttendees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends Controller
{


    public function list_meetings(Request $request)
    {
       // dd(Auth::guard('employer')->user()->id);

        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',

        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $meetings = Meeting::with('user.position','meeting_attendees.users:id,employer_id,job_title,first_name,last_name,image')->where('employer_id', $request->employer_id)->get();
        if ($meetings) {
            return response()->json([
                'message' => "Success",
                'meetings liste' => $meetings,
            ], 200);

            // if (request()->is('api/*')) {
            //     // This is an API request
            //     return response()->json([
            //         'message' => "Success",
            //         'meetings liste' => $meetings,
            //     ], 200);
            // } else {
            //     // This is a web request
            //     $breadcrumbs = [
            //         [(__('Dashboard')), route('admin.home')],
            //         [(__('Meetings')), null],
            //     ];
            //  //   $tax_settings = TaxSettingsSrtModel::with('country')->get();
            //     return view('employer.meetings.index', compact('breadcrumbs', 'meetings'));
            // }
           
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
            'attendees.*' => 'required'

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
        $meetings->agenda = $request->description;
        $meetings->location = $request->location;

        $issave = $meetings->save();
        if ($issave) {
           

            //Rj 06-03-23
            for ($i = 0; $i < count($request->attendees); $i++) {
                $answers[] = [
                    'meeting_id' => $meetings->id,
                    'attendee_id' => $request->attendees[$i],
                ];
            }
            $issave=MeetingAttendees::insert($answers);
            if($issave)
            {

                return response()->json([
                    'message' => "Success",
                    'chats' => $meetings,
                ], 200);

                // $apiUrl  = env('APP_URL');
                // $response = Http::get($apiUrl);
                // if ($response->successful()) {
                //     // If the API call is successful, return the API response as JSON
                //     return response()->json([
                //         'message' => "Success",
                //         'chats' => $meetings,
                //     ], 200);
                   
                // } else {
                //     // Handle API error response
                //     return view('index');
                //   //  return response()->json(['error' => 'API call failed'], $response->status());
                // }
               
            }
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
        $meeting_attendees = MeetingAttendees::where('meeting_id', $id)->delete();
        if ($deduction && $meeting_attendees) {
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
