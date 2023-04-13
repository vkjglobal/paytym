<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function attendance_search_form(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Report')), null]
        ];
        return view('employer.report.attendace_list',compact('breadcrumbs'));
    }

    public function attendance_search(){
        
    }
}
