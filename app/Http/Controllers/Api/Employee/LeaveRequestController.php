<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Controllers\Api\Employee\AuthController;
use App\Models\AllowedDetail;
use App\Models\Attendance;
use App\Models\Employer;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Roster;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\CommonRequestEmailstoHR;
use Mail;

class LeaveRequestController extends Controller
{
    // List Leave Requests
    public function index()
    {
        $user = Auth::user();
        $employer_id = $user->employer_id;
        $leaveRequests = LeaveRequest::with('leaveType')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $leave_types = LeaveType::select('leave_type')->where('employer_id', $employer_id)->get();

        if (count($leaveRequests) > 0) {
            return response()->json([
                'message' => "Leave Requests List",
                'leaveRequests' => $leaveRequests,
                'leave_types' => $leave_types,
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
        $leaveRequest->start_date = date('Y-m-d H:i:s', strtotime($validated['start_date']));
        $leaveRequest->end_date = date('Y-m-d H:i:s', strtotime($validated['end_date']));
        $leaveRequest->type = $validated['type'];
        $res = $leaveRequest->save();

        $user = User::where('id', Auth::user()->id)->first();
        $hr = User::join('roles', 'users.position', '=', 'roles.id')
        ->where('users.employer_id', $validated['employer_id'])
        ->where('users.status', 1)
        ->where('roles.role_name', 'like', '%HR%')
        ->get();
        $emails = $hr->pluck('email');
                $recipients = $emails->toArray();
                if ($emails->count()>0) {
                    $content = 'A new leave request is received from ' . $user->first_name .' .Please Approve/Reject.';
                    $title = 'New Leave Request Notification';
                    $subject = 'New Leave Request from ' .$user->first_name ;
                    Mail::to($recipients)->send(new CommonRequestEmailstoHR($user,$content,$subject,$title));
                    } 

        if ($res) {
            return response()->json([
                'message' => "Your request has been submitted",
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
        $user = Auth::user();
        $employer_id = $user->employer_id;
        $allowed_details = AllowedDetail::first();


        if ($allowed_details == null) {
            $allowed_absent = 0;
            $allowed_sick_leave = 0;
            $allowed_annual_leave = 0;
            $allowed_late_arrival = 0;
        } else {
            $allowed_absent = $allowed_details->allowed_absent;
            $allowed_sick_leave = $allowed_details->allowed_sick_leave;
            $allowed_annual_leave = $allowed_details->allowed_annual_leave;
            $allowed_late_arrival = $allowed_details->allowed_late_arrival;
        }

        if ($user) {
            // $leave = LeaveRequest::where('status', '1')->where('user_id',$user_id);

            // $casual = $leave->with(['leaveType' => function ($query) {
            //     $query->where('leave_type', 'LIKE', '%casual%');
            // }])->get();
            $sickleave = LeaveRequest::where('status', '1')
            ->where('user_id', $user_id);
         
            $sickJoinTable = $sickleave->join('leave_types', 'leave_requests.type', 'leave_types.id');
            $sicks = $sickJoinTable->where('leave_types.leave_type', 'LIKE', '%sick%')->get();
            $sick = $sicks->count();

            $casualleave = LeaveRequest::where('status', '1')
            ->where('user_id', $user_id);
            $casualJoinTable = $casualleave->join('leave_types', 'leave_requests.type', 'leave_types.id');
            $casuals = $casualJoinTable->where('leave_types.leave_type', 'LIKE', '%casual%')->get();
            $casual = $casuals->count();
            $absenceleave = LeaveRequest::where('status', '1')
            ->where('user_id', $user_id);
        
            $absence = $absenceleave->get();
            $absence = $absence->count();

            $annualleave = LeaveRequest::where('status', '1')
            ->where('user_id', $user_id);
            $annualJoinTable = $annualleave->join('leave_types', 'leave_requests.type', 'leave_types.id');
            $annual = $annualJoinTable->where('leave_types.leave_type', 'LIKE', '%annual%')->get();
            $annual = $annual->count();

            $halfdayleave = LeaveRequest::where('status', '1')
            ->where('user_id', $user_id);

            $halfdayJoinTable = $halfdayleave->join('leave_types', 'leave_requests.type', 'leave_types.id');
            $halfday = $halfdayJoinTable->where('leave_types.leave_type', 'LIKE', '%annual%')->get();
            $halfday = $halfday->count();


            // $halfdayJoinTable = $leave->join('leave_types', 'leave_requests.type', 'leave_types.id');
            // $halfday = $halfdayJoinTable->where('leave_types.leave_type', 'LIKE', '%annual%')->get();
            // $halfday = $halfday->count();
        
            
        
            $lastCheckedIn = Null;
            $lastAttendance = Attendance::where('user_id', $user->id)->latest()->first();
            if ($lastAttendance) {
                if (is_null($lastAttendance->check_out)) {
                    $lastCheckedIn = $lastAttendance->check_in;
                }
            }

            $roster = Roster::where('user_id', $user_id)->where('start_date', '<=', Carbon::today())
                ->where('end_date', '>=', Carbon::today())->get();
            if (!$roster->isEmpty()) {
                $roster_check_in_time = Roster::where('user_id', $user_id)->value('start_time');
            } else {
                $roster_check_in_time = Employer::select('check_in_time')->where('id', $employer_id)->value('check_in_time');
            }

            try {
                $late_arrival = Attendance::where('user_id', $user_id)
                    ->whereTime('check_in', '>', $roster_check_in_time)->count();
            } catch (Exception $e) {
                $late_arrival = 0;
            }

            $total_work_days = Attendance::where('user_id', $user_id)->whereYear('date', Carbon::now()->format('Y'))->count();
            $next_shift = Roster::where('user_id', $user_id)->whereDate('start_date', '<=', Carbon::today())
                ->whereDate('end_date', '>=', Carbon::today())->orderBy('id', 'desc')->first();
            // $total_work_hours = ;
            (float)$hours = 0;
            $attendances = Attendance::where('user_id', $user_id)->whereBetween('date', [$user->employment_start_date, Carbon::today()])->get();
            foreach ($attendances as $attend) {
                $check_in = Carbon::parse($attend->check_in);
                $check_out = Carbon::parse($attend->check_out);
                if ($check_in != NULL && $check_out != NULL) {
                    $hours += $check_in->diffInHours($check_out);
                }
            }

            return response()->json([
                'message' => "Dashboard details listed",
                'casual' => $casual,
                'absence' => $absence,
                'annual' => $annual,
                'halfday' => $halfday,
                'sick' => $sick,
                'late_arrival' => $late_arrival,
                'total_work_days' => $total_work_days,
                'hours' => $hours,
                'roster_check_in_time' => $roster_check_in_time,
                'next shift' => $next_shift,
                'last_checked_in' => $lastCheckedIn,
                'allowed_absent' => $allowed_absent,
                'allowed_sick_leave' => $allowed_sick_leave,
                'allowed_annual_leave' => $allowed_annual_leave,
                'allowed_late_arrival' => $allowed_late_arrival,
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
        // $leave = [];
        // $projects = [];
        // $meetings = [];
        // $attendance = [];
        // $leave = LeaveRequest::where('status', '1')->where('employer_id', $request->employer_id)->get();
        // $projects = Project::where('employer_id', $request->employer_id)->get();
        // $meetings = Meeting::where('employer_id', $request->employer_id)->get();
        // $attendance = Attendance::where('employer_id', $request->employer_id)->get();

        $today = Carbon::today();
        $projects_count = Project::where('employer_id', $request->employer_id)->count();
        $employees_count = User::where('employer_id', $request->employer_id)->count();
        $attendance_count = Attendance::where('employer_id', $request->employer_id)->where('date', '=', $today)->count();
        $absentees_count = $employees_count - $attendance_count;
        // $absentees_count = Attendance::where('employer_id', $request->employer_id)->where('check_in', '=', null)->where('date', '=', $today)->count();
        $meetings_count = Meeting::where('employer_id', $request->employer_id)->where('date', '=', $today)->count();
        $pending_leaves = LeaveRequest::where('employer_id', $request->employer_id)->where('status', '0')->count();
        $active_employees_count = User::where('employer_id', $request->employer_id)->where('status', '1')->count();

        return response()->json([
            'message' => "Dashboard details listed",
            // 'leave' => $leave,
            // 'projects' => $projects,
            // 'meetings' => $meetings,
            // 'attendance' => $attendance,
            'projects_count' => $projects_count,
            'attendance_count' => $attendance_count,
            'absentees_count' => $absentees_count,
            'employees_count' => $employees_count,
            'meetings_count' => $meetings_count,
            'pending_leaves' => $pending_leaves,
            'active_employees_count' => $active_employees_count,

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
        $leaveRequest = LeaveRequest::with('user:id,first_name,last_name,branch_id,department_id')->where('employer_id', $employer_id)->where('status', 0);
        if ($status == '1') {
            $leaveRequest = $leaveRequest->whereMonth('created_at', Carbon::now()->month)->orderBy('id', 'desc')->get();
        } elseif ($status == '2') {
            $leaveRequest = $leaveRequest->whereDate('created_at', '=', Carbon::yesterday())->orderBy('id', 'desc')->get();
        } elseif ($status == '3') {
            $leaveRequest = LeaveRequest::with('user:id,first_name,last_name,branch_id,department_id')->where('employer_id', $employer_id)->whereYear('created_at', '=', Carbon::now())->orderBy('id', 'desc')->get();
        } else {
            $leaveRequest = $leaveRequest->orderBy('id', 'desc')->get();
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
            'leave_request_id' => 'required',
            'reason' => 'required',

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
        $leave_request_id = $request->leave_request_id;
        $leave_request = LeaveRequest::where('user_id', $employee_id)->where('status', '0')
            ->where('id', $leave_request_id)->first();
        if ($leave_request) {
            if ($approval_status == '0') {
                $leave_request->status = '2';
                $message = "Your leave request is rejected.";
            } else {
                $leave_request->status = '1';
                $message = "Your leave request is approved.";
            }
            $leave_request->reason = $request->reason;
            $issave = $leave_request->save();
            if ($issave) {
                $otherController = new AuthController();
                $result = $otherController->push_notification($request, $request->employee_id, $message);
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

    public function get_leave_types(Request $request)
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
        $leaveTypes = LeaveType::where('employer_id', $request->employer_id)->get();
        if (count($leaveTypes) > 0) {
            return response()->json([
                'leave-types' => $leaveTypes
            ], 200);
        } else {
            return response()->json([
                'message' => "No Record Found",
            ], 400);
        }
    }
}
