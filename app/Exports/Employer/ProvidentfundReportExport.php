<?php

namespace App\Exports\Employer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProvidentfundReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.providentfund_list', [
            'employees' => $employees
        ]);
    }
}
