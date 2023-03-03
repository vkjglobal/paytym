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

class AttendanceReportExport implements FromView
{   
    protected $employeesid;
    protected $date_from;
    protected $date_to;

    public function __construct($employees, $date_from = null, $date_to = null)
    {
        $this->employeesid = $employees;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }
    public function view(): View
    {
        // $report_controller = new ReportController();
        // $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        $employees = User::where('employer_id', Auth::guard('employer')->id())->whereIn('id', $this->employeesid)->get();
        return view('employer.report.export.attendance_list_filter', [
            'employees' => $employees,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'today' => Carbon::now()->format('Y-m-d'),
        ]);
    }
}
