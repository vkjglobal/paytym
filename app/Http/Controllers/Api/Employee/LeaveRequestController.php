<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    // List Leave Requests
    public function index()
    {
        $user = Auth::user();
        $leaveRequests = LeaveRequest::where('user_id', $user->id)->get();

        if (count($leaveRequests) > 0) {
            return response()->json([
                'message' => "Leave Requests List",
                'leaveRequests' => $leaveRequests,
            ], 200);
        } else {
            return response()->json([
                'message' => "No list present"
            ], 400);
        }
    }

    // Store Leave Request
    public function store(StoreLeaveRequest $request)
    {
        $validated = $request->validated();
        $leaveRequest = new LeaveRequest();
        $leaveRequest->user_id = Auth::user()->id;
        $leaveRequest->title = $validated['title'] ?? null;
        $leaveRequest->start_date = date('Y-m-d', strtotime($validated['start_date']));
        $leaveRequest->end_date = date('Y-m-d', strtotime($validated['end_date']));
        $leaveRequest->type = $validated['type'];
        $res = $leaveRequest->save();

        if ($res) {
            return response()->json([
                'message' => "Your request send successfully",
            ], 200);
        } else {
            return response()->json([
                'message' => "Your request was not send. Please try again."
            ], 400);
        }
    }

    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $leave = LeaveRequest::where('status', '1')->where('user_id',$user_id);
        if($leave)
        {
            $casual=LeaveRequest::where('status', '1')->where('user_id',$user_id)->where('type','casual')->get();
            $casual=$casual->count();
            $absence=LeaveRequest::where('status', '1')->where('user_id',$user_id)->get();
            $absence=$absence->count();
            $annual=LeaveRequest::where('status', '1')->where('user_id',$user_id)->where('type','annual')->get();
            $annual=$annual->count();
            $halfday=LeaveRequest::where('status', '1')->where('user_id',$user_id)->where('type','halfday')->get();
            $halfday=$halfday->count();
            return response()->json([
                'message' => "Dash Board details listed",
                'casual' =>$casual,
                'absence' =>$absence,
                'annual' =>$annual,
                'halfday' =>$halfday,
            ], 200);

        }
        else{
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }
}
