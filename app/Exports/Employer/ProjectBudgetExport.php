<?php

namespace App\Exports\Employer;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ProjectBudgetExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
       // $projects = Project::where('employer_id', Auth::guard('employer')->id())->latest()->get();
        $projects = Project::select('id', 'name', 'start_date','budget')
        ->where('employer_id', Auth::guard('employer')->user()->id)
        ->withCount([
            'projectExpenses as total_expense' => function ($query) {
                $query->select(DB::raw('SUM(expense_amount)'));
            },
        ])
        ->get();
        return view('employer.report.table.projectbudget_list_table',compact('projects'));
    }
}
