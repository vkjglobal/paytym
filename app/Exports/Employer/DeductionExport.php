<?php

namespace App\Exports\Employer;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class DeductionExport implements FromView
{
    public function view(): View
    {
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.deduction_list', [
            'employees' => $employees
        ]);
    }
}
