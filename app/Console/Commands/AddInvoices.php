<?php

namespace App\Console\Commands;

use App\Models\CustomSubscription;
use App\Models\Employer;
use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\User;
use App\Models\BillingEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceEmail;
use Dompdf\Dompdf;
use Dompdf\Options;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AddInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create the invoice of the employer for that month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{

        // Get the current month and year
      
         $date = Carbon::today();

        //Employers
        $employers = Employer::where('status', '1')->get();

        // Create or update the invoice for the current month and year
     foreach($employers as $employer){
            $invoice = new Invoice();
                
                $invoice->employer_id = $employer->id;
                
                $total_active_employees = User::where('employer_id', $employer->id)->where('status', '1')->count();

                if($total_active_employees == 0){
                    $plan = Subscription::first();
                }elseif($total_active_employees > Subscription::orderBy('id', 'desc')->get()->value('range_to')){
                    $plan = Subscription::orderBy('id', 'desc')->first();
                }else{
                    $plan = Subscription::where('range_from', '<=', $total_active_employees)->where('range_to', '>=', $total_active_employees)->first();
                }

                $custom_plan = CustomSubscription::where('employer_id', $employer->id)->first();

                if($custom_plan == null){
                    $invoice->plan_id = $plan->id;
                    $invoice->amount = $plan->rate_per_month + ($total_active_employees*$plan->rate_per_employee);
                }else{
                    $invoice->plan_id = $custom_plan->id;
                    $invoice->custom_plan_id = $custom_plan->id;
                    $invoice->amount = $custom_plan->rate_per_month + ($total_active_employees*$custom_plan->rate_per_employee);
                }
                
                $invoice->date = $date;
                $invoice->active_employees = $total_active_employees;
                $total_employee_rate = $plan->rate_per_employee * $invoice->active_employees;
                $currentYear = Carbon::now()->format('Y');
        
                // Get the last generated invoice number for the current year
                 $lastInvoice = Invoice::whereYear('created_at', $currentYear)
                    ->orderByDesc('id')
                    ->first();
        
                $sequenceNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -4)) + 1 : 1;
                $paddedSequenceNumber = str_pad($sequenceNumber, 6, '0', STR_PAD_LEFT);
        
                $invoiceNumber = "{$currentYear}-{$paddedSequenceNumber}"; 
                //$invoiceNumber =  date('YmdHis'); 
                $invoice->invoice_number = $invoiceNumber;
              $invoice->save();
           $pdfInvoice = $this->generatePdfInvoice($employer, $invoice, $plan, $total_employee_rate, $invoiceNumber);
            
           $billingEmails = BillingEmail::where('employer_id',$employer->id)->pluck('email');
           if ($billingEmails->isEmpty()) {
            // No billing email addresses, send the email only to the primary employer's email.
            Mail::to($employer->email)
                ->send(new InvoiceEmail($employer, $invoice, $plan, $total_employee_rate, $invoiceNumber, $pdfInvoice));
        } else {
            // Send the email to the primary employer's email and add billing emails as carbon copy recipients.
            //$recipients = collect([$employer->email])->concat($billingEmails);
            //$recipients = $billingEmails->prepend($employer->email);
            
            
            $recipients = $billingEmails->toArray();
            //info($recipients);
            Mail::to($employer->email)
            ->cc($recipients)
        ->send(new InvoiceEmail($employer, $invoice, $plan, $total_employee_rate, $invoiceNumber, $pdfInvoice));
            
        
        //Mail::to($recipients->toArray())
            //->send(new InvoiceEmail($employer, $invoice, $plan, $total_employee_rate, $invoiceNumber, $pdfInvoice));
           
            /*$recipients = collect([$employer->email])->concat($billingEmails)->toArray();
            foreach($recipients as $rcpt)
            {
                Mail::to($rcpt)
            ->send(new InvoiceEmail($employer, $invoice, $plan, $total_employee_rate, $invoiceNumber, $pdfInvoice));
            }*/
        }
        }
            

        $this->info('Invoices Created Successfully!');

        return Command::SUCCESS; 
    
    } catch (\Exception $e) {
        // Log the exception details
        info('Exception: ' . $e->getMessage());
        // You might also want to throw the exception for proper handling
        throw $e;
    }
    }

    public function generatePdfInvoice($employer,$invoice, $plan, $total_employee_rate, $invoiceNumber)
    {
        // Create PDF options
        $pdfOptions = new Options();
        //$pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);
        

        // Initialize PDF
        $dompdf = new Dompdf($pdfOptions);
        //$dompdf->setBasePath(asset('home_assets/images/logo.png'));

        // Generate HTML for the invoice (you can put your HTML here)
        $html = view('mail.invoice-pdf', [
            'employer' => $employer,
            'invoice' => $invoice,
            'plan' => $plan,
            'total_employee_rate' => $total_employee_rate,
            'invoiceNumber' => $invoiceNumber,
        ])->render();

        // Load HTML content
        $dompdf->loadHtml($html);

        // Render PDF (optional: adjust size and orientation)
        //$dompdf->setPaper('A4', 'portrait');
        
        $dompdf->render();

        // Return the generated PDF content
        return $dompdf->output();
    }

    
}
