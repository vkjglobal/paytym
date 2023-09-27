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
        $meetings = MeetingAttendees::with('meetings', 'meetings.meeting_attendees.users:id,employer_id,job_title,first_name,last_name,image', 'meetings.user', 'meetings.user.role')->orderBy('id', 'desc')->where('attendee_id', Auth::user()->id)->get();
        // Now, you can modify the $meetings collection to replace "meeting_attendees" with just the "users" data
        $meetings->each(function ($meeting) {
            $meeting->meetings->meeting_attendeess = $meeting->meetings->meeting_attendees->pluck('users');
            unset($meeting->meetings->meeting_attendees);
        });

        if ($meetings) {
            return response()->json([
                'message' => "Success",
                "meetings_list" => $meetings,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Records"
            ], 400);
        }
    }
}
