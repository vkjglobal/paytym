<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\InvoiceReportExport;
use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\Admin\ReportExport;
use App\Exports\Employer\EmployerReportExport;
use App\Models\Invoice;
use App\Models\Subscription;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Report')), null],
        ];

        $companies = Employer::all();
        $employees = User::all();
        $plans = Subscription::all();
        return view('admin.reports.index', compact('companies', 'breadcrumbs', 'plans'));
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

    public function filter(Request $request) 
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Report')), null],
        ];

        $companies = Employer::all();
        $employees = User::all();
        $plans = Subscription::all();
        return view('admin.reports.index', compact('companies', 'breadcrumbs', 'plans'));
    }

    public function invoice_index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Report')), null],
        ];

        $invoices = Invoice::orderby('date', 'desc')->get();
        return view('admin.reports.invoice_list', compact('invoices', 'breadcrumbs'));
    }

    public function invoice_export() 
    {
        return Excel::download(new InvoiceReportExport, 'invoice_list_export-'.Carbon::now().'.xlsx');
    }

    public function invoice_filter(Request $request) 
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Report')), null],
        ];

        $invoices = Invoice::orderby('date', 'desc')->where('status', $request->status)->get();
        $status = $request->status;
        return view('admin.reports.invoice_list', compact('invoices', 'breadcrumbs', 'status'));
    }


    public function employer_list_export() 
    {
        return Excel::download(new EmployerReportExport, 'employer_report_export-'.Carbon::now().'.xlsx');
    }

}
