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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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

         $sourceString = join('|', [
            'nar_cardType' => 'EX',
            'nar_merBankCode' => '01',
            'nar_merId' => '876500008765001',
            'nar_merTxnTime' => date('YmdHis'),//'20161031152438',
            'nar_msgType' => 'AR',
            'nar_orderNo' => 'ORD_' . date('YmdHis'),//$invoice->invoice_number,
            'nar_paymentDesc' => 'Merchant Simulator Test Txn',
            'nar_remitterEmail' => $employer->email,//'customermail@gmail.com',
            'nar_remitterMobile' => $employer->phone,//'12323213',
            'nar_txnAmount' => $invoice->amount,//'1.00',
            'nar_txnCurrency' => '242',
            'nar_version' => '1.0',
            'nar_returnUrl' => 'https://paytym.net/employer/checkresponse',
            //'nar_returnUrl' => 'https://uat2.yalamanchili.in/pgsim/checkresponse',
            
        ]);
        $binary_signature ="";
        $privateKeyPath = env('MERCHANT_PRIVATE_KEY');
        $passphrase = env('MERCHANT_PRIVATE_KEY_PASSPHRASE');
        $fp = fopen($privateKeyPath, 'r');
        $privKey = fread($fp, 8192);
        fclose($fp);
        //dd($sourceString);
        //dd($privKey);
        $res = openssl_get_privatekey($privKey);
        //$res = openssl_get_privatekey($privateKey, $passphrase);
       openssl_sign($sourceString, $binary_signature, $res, OPENSSL_ALGO_SHA1);
       //dd(openssl_sign($sourceString, $binarySignature, $res, OPENSSL_ALGO_SHA1));
        openssl_free_key($res);
        //echo "Generate CheckSUM: ";
        //var_dump(bin2hex($binary_signature)); //Convert Binary Signature Value to HEX */
        $bs = $binary_signature;
        //dd($bs);
        $checksumkey = bin2hex($binary_signature);

        Log::info('Source String: ' . $sourceString);
        Log::info('Binary Signature: ' . bin2hex($binary_signature));
        Log::info('Checksum: ' . $checksumkey);

        //dd(bin2hex($binary_signature));
        return view('employer.invoice.pay_invoice', compact('breadcrumbs','invoice', 'card' , 'employer',
        'checksumkey', 'bs'));
    }

    public function invoice_checkout($invoiceId)
    {
        $invoice = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->where('id',$invoiceId)->first();
        //return $invoice;
        $card = CreditCard::where('employer_id', Auth::guard('employer')->user()->id)->first();
        $employer = Auth::guard('employer')->user();
        //dd($employer);
        $sourceString = join('|', [
            'nar_cardType' => 'EX',
            'nar_merBankCode' => '01',
            'nar_merId' => '876500008765001',
            'nar_merTxnTime' => date('YmdHis'),//'20161031152438',
            'nar_msgType' => 'AR',
            'nar_orderNo' => 'ORD_' . date('YmdHis'),//$invoice->invoice_number,
            'nar_paymentDesc' => 'Merchant Simulator Test Txn',
            'nar_remitterEmail' => $employer->email,//'customermail@gmail.com',
            'nar_remitterMobile' => $employer->phone,//'12323213',
            'nar_txnAmount' => $invoice->amount,//'1.00',
            'nar_txnCurrency' => '242',
            'nar_version' => '1.0',
            'nar_returnUrl' => 'https://paytym.net/employer/checkresponse',
            //'nar_returnUrl' => 'https://uat2.yalamanchili.in/pgsim/checkresponse',

        ]);
        $binary_signature ="";
        $privateKeyPath = env('MERCHANT_PRIVATE_KEY');
        $passphrase = env('MERCHANT_PRIVATE_KEY_PASSPHRASE');
        $fp = fopen($privateKeyPath, 'r');
        $privKey = fread($fp, 8192);
        fclose($fp);
        $res = openssl_get_privatekey($privKey);
       openssl_sign($sourceString, $binary_signature, $res, OPENSSL_ALGO_SHA1);
        openssl_free_key($res);
        $bs = $binary_signature;
        $checksumkey = bin2hex($binary_signature);

        Log::info('Source String: ' . $sourceString);
        Log::info('Binary Signature: ' . bin2hex($binary_signature));
        Log::info('Checksum: ' . $checksumkey);

        return view('employer.invoice.invoice_checkout', compact('invoice', 'card','employer','checksumkey'));
    }

    public function checkResponse(Request $request)
    {
        Log::info('Response Data from Payment Gateway:', $request->all());
        $sourceString = join('|', [
            'nar_cardType' => 'EX',
            'nar_merBankCode' => '01',
            'nar_merId' => $request->nar_merId,
            'nar_merTxnTime' => $request->nar_merTxnTime,//'20161031152438',
            'nar_msgType' => $request->nar_msgType,
            'nar_orderNo' => $request->nar_orderNo,
            'nar_paymentDesc' => $request->nar_paymentDesc,
            'nar_remitterEmail' => $request->nar_remitterEmail,//'customermail@gmail.com',
            'nar_remitterMobile' => $request->nar_remitterMobile,//'12323213',
            'nar_txnAmount' => $request->nar_txnAmount,//'1.00',
            'nar_txnCurrency' => '242',
            'nar_version' => '1.0',
            'nar_returnUrl' => $request->nar_returnUrl,
        ]);
        Log::info('Source String: ' . $sourceString);
       //dd($sourceString);

        // Retrieve private key and passphrase from config
        $binary_signature =$request->bs;
       
        
        $attempts = 3;
$retryDelay = 5; // Delay in seconds between retries

for ($i = 1; $i <= $attempts; $i++) {
    try {
        $response = Http::withOptions(['timeout' => 10])->post(env('BSP_API_URL'), [
            'data' => $sourceString,
            'checksum' => $checksum,
        ]);
        // Check if the response was successful
        if ($response->successful()) {
            // Handle the response
            break; // Exit the loop if successful
        }
    } catch (\Exception $e) {
        // Handle the exception (e.g., log the error)
    }
    
    if ($i < $attempts) {
        sleep($retryDelay); // Wait before the next retry
    }
    
       
    //dd($request);
    $publicKeyPath = env('BSP_PUBLIC_KEY');
    $fpq=fopen ($publicKeyPath,"r");
    $pub_key=fread($fpq,8192); 
    fclose($fpq);
    //dd($pub_key);

    $pubs = openssl_get_publickey($pub_key);
    //dd($pubs);
   // $ok = openssl_verify($data, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
    $ok = openssl_verify($sourceString, $binary_signature, $pubs, OPENSSL_ALGO_SHA1);
    dd($ok);
    //session(['okvalue' => $ok]);
    Log::info('Response Data: ' . json_encode($request->all()));
    Log::info('Response Data from Payment Gateway:', $request->all());
    Log::info('Checksum Verification Result: ' . $ok);  
    echo "check #1: Verification "; 
    if ($ok == 1) {
    //
   // dd($request->all());
    /*$employer = Auth::guard('employer')->user(); 
    $invoice = Invoice::with('plan')->where('employer_id', Auth::guard('employer')->user()->id)->orderBy('created_at', 'desc')->first();
    $invoice->update(['status' => 1]);*/
    session()->flash('success', ' Transaction Successful!! Thanks for your payment. Please continue your subscription to access our superior Paytym HR and Payroll Automation Platform.
    Thank you once again !.');
    return view('employer.invoice.transaction_status');
    //echo "signature ok (as it should be)\n";
    } elseif ($ok == 0) { 
   
    session()->flash('success', ' Transaction Unsuccessful!! Please Retry!.');
        return view('employer.invoice.transaction_status');
       // return redirect()->route('employer.home');
    //echo "bad (there's something wrong)\n";
   
    } else {
    echo "ugly, error checking signature\n";
    }
   
}
        //dd($request->all());
        /* if($request)
        {
        session()->flash('success', ' Transaction Successful!! Thanks for your payment. Please continue your subscription to access our superior Paytym HR and Payroll Automation Platform.
        Thank you once again !.');
        return view('employer.invoice.transaction_status');
        } */
       // return view('employer.invoice.transaction_status');
    }
    
}
