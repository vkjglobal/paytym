<?php

namespace App\Exports\Employer;
use App\Http\Controllers\Employer\ReportController;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeePeriodExport implements FromView
{
    public function view(): View
    {
        // $report_controller = new ReportController();
        // $employees = $report_controller->attendance_filter();
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.employee_period_list', [
            'employees' => $employees
        ]);
    }
}
