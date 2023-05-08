<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingAttendees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingsController extends Controller
{
    public function meetings()
    {
        $user_id = Auth::user()->id;
        $meetings = MeetingAttendees::with('meetings:id,name,user_id,start_time,end_time,date,location', 'meetings.user:id,position,first_name,last_name')->where('attendee_id',Auth::user()->id)->get();
        if ($meetings) {
            return response()->json([
                'message' => "Success",
                "meetings" => $meetings,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records"
            ], 400);
        }
    }
}
