<?php

namespace App\Exports\Employer;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class StatusProjectExport implements FromView
{
    public function view(): View
    {
        $projects = Project::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.status_project', [
            'projects' => $projects
        ]);
    }
}
