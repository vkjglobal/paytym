<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\Admin\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


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
        return Excel::download(new ReportExport, 'allowance_export-'.Carbon::now().'.xlsx');
    }

    public function download() 
    {
        $datas = Employer::all();
        $data = 'hello';
        $pdf = Pdf::loadView('admin.reports.report_template', $data, compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
