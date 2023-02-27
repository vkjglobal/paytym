<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\QuitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Leave Requests')), null],
        ];

        $leaveRequests = LeaveRequest::with('user')->where('employer_id', Auth::guard('employer')->id())->latest()->get();
        // dd($leaveRequests);
        return view('employer.leave-requests.index', compact('breadcrumbs', 'leaveRequests'));
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
            $req->message = NULL;
            $msg = 'Approved';
        }else{
            $req->status = $request->reject;
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
            $req->message = $request->message;
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
