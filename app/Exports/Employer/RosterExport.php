<?php

namespace App\Exports\Employer;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Roster;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Auth;


class RosterExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $rosters = Roster::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.roster.table.roster_report_table', [
            'rosters' => $rosters
        ]);
    }
}
