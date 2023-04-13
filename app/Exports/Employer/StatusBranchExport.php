<?php

namespace App\Exports\Employer;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StatusBranchExport implements FromView
{
    public function view(): View
    {
        $branches = Branch::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.status_branch', [
            'branches' => $branches
        ]);
    }
}
