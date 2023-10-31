<?php

namespace App\Exports\Employer;
use App\Models\FrcsEmployeeData;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeFRCSExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
        $frcs = FrcsEmployeeData::where('employer_id', Auth::guard('employer')->user()->id)
               ->get();
        return view('employer.report.table.employeefrcs_list_table',compact('frcs'));
    }
}
