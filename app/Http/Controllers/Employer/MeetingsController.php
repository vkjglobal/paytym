<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingsController extends Controller
{
    //
public function index()
{
    $breadcrumbs = [
        [(__('Dashboard')), route('admin.home')],
        [(__('Meetings')), null],
    ];
    $employer_id=Auth::guard('employer')->user()->id;

    $meetings = Meeting::with('user.position')->where('employer_id', $employer_id)->get();
    return view('employer.meetings.index', compact('breadcrumbs', 'meetings'));
}

public function create()
{
   
}

}
