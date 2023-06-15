<?php

namespace App\Exports\Employer;

use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployerReportExport implements FromView
{
    public function view(): View
    {
        return $employees = Employer::get();
        // return view('employer.report.export.employee_list', [
        //     'employees' => $employees
        // ]);
    }

}
