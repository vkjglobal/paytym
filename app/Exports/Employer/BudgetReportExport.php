<?php

namespace App\Exports\Employer;

use App\Models\PayrollBudget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;


class BudgetReportExport implements FromView
{

    public function view(): View
    {
        $budgets = PayrollBudget::where('employer_id', Auth::guard('employer')->id())->orderBy('year', 'desc')->get();
        return view('employer.report.export.budget_list',compact('budgets'));
    }
}
