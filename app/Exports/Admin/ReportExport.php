<?php

namespace App\Exports\Admin;

use App\Models\Employer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class ReportExport implements FromView
{
    public function view(): View
    {
        $companies = Employer::all();
        return view('admin.reports.export.index', [
            'companies' => $companies
        ]);
    }
}
