<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Employer;
use App\Models\CreditCard;
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
        $employer = Auth::guard('employer')->user();
        return view('employer.invoice.index', compact('breadcrumbs', 'plan','employer'));
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
        $totalamount = $plan->plan->rate_per_month + ($plan->active_employees*$plan->plan->rate_per_employee);
        //return $totalamount;
        /* $pdf = PDF::loadView('employer.invoice.view_invoice', compact('breadcrumbs', 'plan','employer','total_employee_rate'));
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $fileName = date('ymd') . time() . '.' . $employer->id;
        $pdf->save(storage_path('user_assets/invoices/invoice.pdf')); */
        //return storage_path('app/temp/invoice.pdf');

        return view('employer.invoice.view_invoice', compact('breadcrumbs', 'plan','employer','total_employee_rate','totalamount'));
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

public function download_email_invoice($id)
{
    //$Id = $request->input('id'); 
    
    // Get the email with the given ID (you need to implement this logic)
    $email = Employer::find($Id);
 return $email;
    // Check if the email has attachments
    if ($email->hasAttachments()) {
        // Get the attachments
       $attachments = $email->getAttachments();

        // In this example, we assume there's only one attachment, but you can loop through $attachments if there are multiple attachments
        $attachment = $attachments[0];

        // Download the attachment
        return response()->stream(
            function () use ($attachment) {
                echo $attachment->getContent();
            },
            200,
            [
                'Content-Type' => $attachment->getContentType(),
                'Content-Disposition' => 'attachment; filename="' . $attachment->getFilename() . '"',
            ]
        );
    } else {
        // Handle the case where no attachments are found
        return response()->json(['message' => 'No attachments found in the email'], 404);
    }
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
    public function list_invoice($invoiceId)
    {
        /*$plan = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->orderBy('date', 'desc')->get();
        return view('employer.invoice.list_invoice', compact('plan'));*/
        $employer = Auth::guard('employer')->user();
        if($employer)
        {
        //return($employer);
        $plan = Invoice::with('plan')->where('id', $invoiceId)->first();
        $total_employee_rate = $plan->plan->rate_per_employee * $plan->active_employees;
        $totalamount = $plan->plan->rate_per_month + ($plan->active_employees*$plan->plan->rate_per_employee);
        //return $plan;
        
        return view('employer.invoice.list_invoice', compact('plan','employer','total_employee_rate','totalamount'));
        }
        else
        {
            return redirect()->route('employer.login');
        }

    }

    public function pay_invoice($invoiceId)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.invoice.index')],
            [(__('Pay Invoice')), null],
        ];
        $invoice = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->where('id',$invoiceId)->first();
        //return $invoice;
        $card = CreditCard::where('employer_id', Auth::guard('employer')->user()->id)->first();
        $employer = Auth::guard('employer')->user();
        return view('employer.invoice.pay_invoice', compact('breadcrumbs','invoice', 'card' , 'employer'));
    }

    public function invoice_checkout($invoiceId)
    {
        $invoice = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->where('id',$invoiceId)->first();
        //return $invoice;
        $card = CreditCard::where('employer_id', Auth::guard('employer')->user()->id)->first();
        return view('employer.invoice.invoice_checkout', compact('invoice', 'card'));
    }
    
}
