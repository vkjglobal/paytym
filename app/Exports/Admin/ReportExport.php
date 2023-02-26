<?php

namespace App\Exports\Admin;

use App\Models\Employer;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employer::all();
    }
}
