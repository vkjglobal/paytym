<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\QuitRequest;
use App\Models\User;
use App\Mail\CommonRequestEmailstoHR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Leave Requests')), null],
        ];

        $leaveRequests = LeaveRequest::with('user')->where('employer_id', Auth::guard('employer')->id())->latest()->get();
        // dd($leaveRequests);
        return view('employer.leave-requests.index', compact('breadcrumbs', 'leaveRequests'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Create Employee Requests')), null],
        ];

        $leave_types = LeaveType::where('employer_id', Auth::guard('employer')->id())->get();
        $users = User::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $branches = Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.leave-requests.create', compact('breadcrumbs','leave_types', 'users', 'businesses', 'branches', 'departments'));
    }

    public function store(Request $request)
    {
       
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Create Leave Requests')), null],
        ];

        $validated = $request->validate([
            'user' => 'required',
            'title' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ]);

        $leave_request = new LeaveRequest();
        $leave_request->user_id = $request->user;
        $leave_request->employer_id = Auth::guard('employer')->id();
        $leave_request->title = $request->title;
        $leave_request->type = $request->leave_type;
        $leave_request->start_date = $request->start_date;
        $leave_request->end_date = $request->end_date;
        $leave_request->reason = $request->reason;
        $leave_request->status = '0';
        $issave = $leave_request->save();

        $user = User::where('id', $request->user)->first();
        $hr = User::join('roles', 'users.position', '=', 'roles.id')
        ->where('users.employer_id', Auth::guard('employer')->id())
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

    
        if($issave){
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $contact = LeaveRequest::where('id', $id)->firstorFail();
        $res = $contact->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function statusChange($id, Request $request)
    {
        $req = LeaveRequest::findOrFail($id);
        if($request->approve){
            $req->status = $request->approve;
            $req->reason = $request->message;
            $msg = 'Approved';
        }else{
            $req->status = $request->reject;
            $req->reason = $request->message;
            $msg = 'Rejected';
        }
        // $req->status = $request->approve;
        $res = $req->save();

        if ($res) {
            notify()->success(__('Status changed. '.$msg));
        } else {
            notify()->error(__('Failed to change. Please try again'));
        }
        return redirect()->back();
        // if ($request->status == 1){
        //     $data = 'Approved';
        // } elseif($request->status == 2) {
        //     $data = 'Rejected';
        // }
        // $datas = ['id' => $request->id, 'data' => $data];
        // return response()->json($datas);
    }

    public function message($id, Request $request)
    {
        $req = LeaveRequest::findOrFail($id);
        if($request->message){
            $req->reason = $request->message;
        }
        $res = $req->save();

        if ($res) {
            notify()->success(__('Message send'));
        } else {
            notify()->error(__('Failed to change. Please try again'));
        }
        return redirect()->back();

    }


   
}
