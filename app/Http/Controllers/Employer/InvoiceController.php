<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.invoice.index')],
            [(__('Invoice')), null],
        ];
  
        $plan = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->orderBy('date', 'desc')->get();
        return view('employer.invoice.index', compact('breadcrumbs', 'plan'));
    }

    public function view_invoice($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.invoice.index')],
            [(__('Vew Bill')), null],
        ];

        $employer = Auth::guard('employer')->user();
        $plan = Invoice::with('plan')->where('id', $id)->first();
        $total_employee_rate = $plan->plan->rate_per_employee * $plan->active_employees;
        
        /* $pdf = PDF::loadView('employer.invoice.view_invoice', compact('breadcrumbs', 'plan','employer','total_employee_rate'));
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $fileName = date('ymd') . time() . '.' . $employer->id;
        $pdf->save(storage_path('user_assets/invoices/invoice.pdf')); */
        //return storage_path('app/temp/invoice.pdf');

        return view('employer.invoice.view_invoice', compact('breadcrumbs', 'plan','employer','total_employee_rate'));
        //return view('employer.invoice.monthly_invoice', compact('breadcrumbs', 'plan','employer','total_employee_rate'));

    }
    public function download_invoice($id)
{
    $data = []; // Your invoice data
    $employer = Auth::guard('employer')->user();
    $plan = Invoice::with('plan')->where('id', $id)->first();
    $total_employee_rate = $plan->plan->rate_per_employee * $plan->active_employees;
    //$htmlContent = View::make('invoices.invoice_template', $data)->render();
    $htmlContent = View::make('employer.invoice.view_invoice', compact('plan','employer','total_employee_rate'))->render();

    // Set the response headers for downloading an HTML file
    $headers = [
        'Content-Type' => 'text/html',
        'Content-Disposition' => 'attachment; filename="invoice.html"',
    ];

    return response()->make($htmlContent, 200, $headers);
}
    public function generate_invoice()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.invoice.index')],
            [(__('Vew Bill')), null],
        ];

        $activeUsers = User::where('employer_id', Auth::guard('employer')->id())->where('status',1)->get(); 
        $activeUserCount = $activeUsers->count();
        $today = Carbon::today();
        $subscription_plans = Subscription::where('status',1)->get();
        $subscriptionPlan = Subscription::where('range_from', '<=', $activeUserCount)
        ->where('range_to', '>=', $activeUserCount)
        ->orderBy('range_to')
        ->first();
        $employer = Employer::where('id',Auth::guard('employer')->id())->first();
        //dd($employer);
        $package_amount = $subscriptionPlan->rate_per_month;
        $rate_per_employee = $subscriptionPlan->rate_per_employee;
        $total_amount = $package_amount + ($activeUserCount * $rate_per_employee);
        //return $total_amount;
        
        
        $currentYear = Carbon::now()->format('Y');
        
        // Get the last generated invoice number for the current year
        $lastInvoice = Invoice::whereYear('created_at', $currentYear)
            ->orderByDesc('id')
            ->first();

        $sequenceNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -4)) + 1 : 1;
        $paddedSequenceNumber = str_pad($sequenceNumber, 6, '0', STR_PAD_LEFT);

        $invoiceNumber = "{$currentYear}-{$paddedSequenceNumber}";
        return $invoiceNumber;
        $invoice = new Invoice();
        $invoice->employer_id = $employer->id;
        $invoice->plan_id =$subscriptionPlan->id;
        $invoice->date = $today;
        $invoice->active_employees =$activeUserCount;
        $invoice->amount = $package_amount;
       // $invoice->save();

        $plan = Invoice::with('plan')->where('id', $id)->first();
        return view('employer.invoice.monthly_invoice', compact('breadcrumbs', 'plan'));
    }
    
}
