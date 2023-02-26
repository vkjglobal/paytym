<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;

use App\Exports\Admin\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $companies = Employer::all();
        $employees = User::all();
        return view('admin.reports.index', compact('companies'));
    }

    public function export() 
    {
        return Excel::download(new ReportExport, 'report.xlsx');
    }
}
