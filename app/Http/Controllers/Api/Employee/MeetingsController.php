<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingsController extends Controller
{
    public function meetings()
    {
        $user_id = Auth::user()->id;
        $meetings = Meeting::with('user.position')->where('employer_id',Auth::user()->employer_id)->get();
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
