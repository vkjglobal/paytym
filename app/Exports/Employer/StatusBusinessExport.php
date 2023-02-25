<?php

namespace App\Exports\Employer;

use App\Models\EmployerBusiness;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class StatusBusinessExport implements FromView
{
    public function view(): View
    {
        $business = EmployerBusiness::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.status_business', [
            'business' => $business
        ]);
    }
}
