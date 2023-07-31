<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.invoice.index')],
            [(__('Invoice')), null],
        ];

        $plan = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.invoice.index', compact('breadcrumbs', 'plan'));
    }

   public function view_invoice($id)
   {
$breadcrumbs = [
    [(__('Dashboard')), route('employer.invoice.index')],
    [(__('Vew Bill')), null],
];

$plan = Invoice::with('plan')->where('id', $id)->first();
return view('employer.invoice.monthly_invoice', compact('breadcrumbs', 'plan'));
   }

}
