<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Meeting;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $leaveRequest->employer_id = $validated['employer_id'];
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
        $leave = LeaveRequest::where('status', '1')->where('user_id', $user_id);
        if ($leave) {
            $casual = $leave->where('type', 'casual')->get();
            $casual = $casual->count();
            $absence = $leave->get();
            $absence = $absence->count();
            $annual = $leave->where('type', 'annual')->get();
            $annual = $annual->count();
            $halfday = $leave->where('type', 'halfday')->get();
            $halfday = $halfday->count();
            return response()->json([
                'message' => "Dash Board details listed",
                'casual' => $casual,
                'absence' => $absence,
                'annual' => $annual,
                'halfday' => $halfday,
            ], 200);
        } else {
            return response()->json([
                'message' => "Failed to check in"
            ], 400);
        }
    }



    public function admin_dashboard(Request $request)
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
        $leave=[];
        $projects=[];
        $meetings=[];
        $attendance=[];
        $leave = LeaveRequest::where('status', '1')->where('employer_id', $request->employer_id)->get();
        $projects = Project::where('employer_id', $request->employer_id)->get();
        $meetings=Meeting::where('employer_id',$request->employer_id)->get();
        $attendance=Attendance::where('employer_id',$request->employer_id)->get();

        return response()->json([
            'message' => "Dash Board details listed",
            'leave' => $leave,
            'projects' => $projects,
            'meetings' => $meetings,
            'attendance' => $attendance,
        ], 200);

    }



    public function leave_requests_lists(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'status' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $employer_id = $request->employer_id;
        $status = $request->status;
        $year = date("Y");
        $now = new \DateTime();
        $leaveRequest = LeaveRequest::where('employer_id', $employer_id);
        if ($status == '1') {
            $leaveRequest = $leaveRequest->whereMonth('created_at', Carbon::now()->month)->get();
        } elseif ($status == '2') {
            $leaveRequest = $leaveRequest->where('created_at', '=', Carbon::yesterday())->get();
        } else {
            $leaveRequest = $leaveRequest->whereDate('created_at', '=', $now)->get();
        }

        return response()->json([
            'message' => "Leave Request",
            'leaveRequest' => $leaveRequest,
        ], 200);
    }

    public function leave_requests_accept_reject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' =>  'required',
            'approval_status' => 'required',
            'start_date' => 'required'

        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $employee_id = $request->employee_id;
        $approval_status = $request->approval_status;
        $start_date = $request->start_date;
        $leave_request = LeaveRequest::where('user_id', $employee_id)->where('status', '0')
            ->whereDate('start_date', date($start_date))->first();
        if ($leave_request) {
            if ($approval_status == '0') {
                $leave_request->status = '0';
            } else {
                $leave_request->status = '1';
            }
            $issave = $leave_request->save();
            if ($issave) {
                return response()->json([
                    'message' => "Leave Request Status Updated",
                ], 200);
            } else {
                return response()->json([
                    'message' => "Something went Wrong",
                ], 200);
            }
        } else {
            return response()->json([
                'message' => "No Record Found",
            ], 200);
        }
    }
}
