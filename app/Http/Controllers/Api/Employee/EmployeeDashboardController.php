<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Attendance;
use App\Models\Meeting;
use Carbon\Carbon;

class EmployeeDashboardController extends Controller
{
    public function index(){
        $today = Carbon::today();
        $meetings = Meeting::whereDate('start_time', '=', $today)->get()->count();
        $projects = Project::where('status','1')->get()->count();
        $attendance = Attendance::where('check_in', '=', $today)->get()->count();
        $data = [];

        if($meetings == 0){
            $data['meetings'] ='No meetings present';
        }else{
            $data['meetings'] = $meetings;
        }
        if($projects == 0){
            $data['projects'] ='No projects present';
        }else{
            $data['projects'] = $projects;
        }
        if($attendance == 0){
            $data['attendance'] ='No attendance present';
        }else{
            $data['attendance'] = $attendance;
        }

        return response()->json($data,200);
    }
}
