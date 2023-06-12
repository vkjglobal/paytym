<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function list_events(Request $request)
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


        $events = Event::where('employer_id', $request->employer_id)->orderBy('id', 'desc')->get();
        if (count($events) > 0) {
            return response()->json([
                'message' => 'Events List',
                'events' => $events
            ], 200);
        } else {
            return response()->json([
                'message' => 'No events present'
            ], 400);
        }
    }


    public function create_event(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'name' =>  'required',
            'description' =>  'required',
            'place' =>  'required',
            'start_date' =>  'required',
            'start_time' =>  'required',
            'end_date' =>  'required',
            'end_time' =>  'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $event = new Event();
        $event->employer_id = $request->employer_id;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->place = $request->place;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;

        $issave = $event->save();
        if ($issave) {
            return response()->json([
                'message' => 'Event Created',
                'event' => $event
            ], 200);
        }
    }


    public function delete_event(Request $request)
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

        $leave_delete=Event::where('id', $request->id)->delete();
        if($leave_delete)
        {
            return response()->json([
                'message' => "Deleted Successfully"
            ], 200);
        }
        else{
            return response()->json([
                'message' => "Something went Wrong"
            ], 200);
        }
    }


}
