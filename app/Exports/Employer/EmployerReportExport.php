<?php

namespace App\Exports\Employer;

use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployerReportExport implements FromView
{

// public function collection()
//     {
//         return YourModel::all();
//     }


    public function view(): View
    {
        
        

        //$employers = Employer::latest()->get();
        $employers = Employer::with('country')->latest()->get();
        return view('admin.employers.employers_table', compact('employers'));
    }

}
