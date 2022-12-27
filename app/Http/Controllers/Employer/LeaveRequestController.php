<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
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

        $leaveRequests = LeaveRequest::with('user')->latest()->get();
        // dd($leaveRequests);
        return view('employer.leave-requests.index', compact('breadcrumbs', 'leaveRequests'));
    }

   
}
