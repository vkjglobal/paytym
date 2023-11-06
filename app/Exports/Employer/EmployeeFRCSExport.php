<?php

namespace App\Exports\Employer;
use App\Models\FrcsEmployeeData;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeFRCSExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
        //$frcs = FrcsEmployeeData::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $frcs = User::with('frcs')->where('employer_id', Auth::guard('employer')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('employer.report.table.employeefrcs_list_table',compact('frcs'));
    }
}
