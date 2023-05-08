<?php

namespace App\Exports\Employer;

use App\Models\Payroll;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class PayslipReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $payrolls = Payroll::where('employer_id', Auth::guard('employer')->id())->where('payroll_status', '1')->latest()->get();
        return view('employer.report.export.payslip_list_table',compact('payrolls'));
    }
}
