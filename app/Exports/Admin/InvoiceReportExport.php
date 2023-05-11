<?php

namespace App\Exports\Admin;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class InvoiceReportExport implements FromView
{
    public function view(): View
    {
        $invoices = Invoice::orderby('date', 'desc')->get();
        return view('admin.reports.export.invoice_list', compact('invoices'));
    }
}
