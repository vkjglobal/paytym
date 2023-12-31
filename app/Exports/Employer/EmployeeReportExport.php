<?php

namespace App\Exports\Employer;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeReportExport implements FromView
{
    public function view(): View
    {
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.employee_list', [
            'employees' => $employees
        ]);
    }

}
