<?php

namespace App\Exports\Employer;

use App\Models\Payroll;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class AllowanceExport implements FromView
{
    public function view(): View
    {

        $payrolls = Payroll::where('employer_id', Auth::guard('employer')->id())->latest()->get();

        return view('employer.report.export.allowance_list',compact('payrolls'));
    
    }
}
