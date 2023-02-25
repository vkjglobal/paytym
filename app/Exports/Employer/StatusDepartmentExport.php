<?php

namespace App\Exports\Employer;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class StatusDepartmentExport implements FromView
{
    public function view(): View
    {
        $departments = Department::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.status_department', [
            'departments' => $departments
        ]);
    }
}
