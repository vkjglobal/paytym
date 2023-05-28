<?php

namespace App\Exports\Employer;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ProjectBudgetExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $projects = Project::where('employer_id', Auth::guard('employer')->id())->latest()->get();
        return view('employer.report.table.projectbudget_list_table',compact('projects'));
    }
}
