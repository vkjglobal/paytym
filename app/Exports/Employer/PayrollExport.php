<?php

namespace App\Exports\Employer;

use App\Models\Payroll;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class PayrollExport implements FromView
{
    public function view(): View
    {
        $payrolls = Payroll::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.payroll_list', [
            'payrolls' => $payrolls
        ]);
    }
}
