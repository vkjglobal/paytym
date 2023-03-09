<?php

namespace App\Exports\Employer;

use App\Http\Controllers\Employer\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Countable;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Traits\EmployeeFilter;

class AttendanceReportExport implements FromView
{   
    use EmployeeFilter;
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function employer_id()
    {
        return $this->request->employer_id;
    }
    public function view(): View
    {
        $today = Carbon::now()->format('Y-m-d');
        $date_from = $this->request->date_from;
        $date_to = $this->request->date_to;
        $employees = $this->report_filter($this->request); 
        return view('employer.report.export.attendance_list_filter', compact('employees', 'date_from', 'date_to', 'today'));
    }
}
