<?php

namespace App\Console\Commands;

use App\Models\CustomSubscription;
use App\Models\Employer;
use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceEmail;

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
                    $invoice->custom_plan_id = $custom_plan->id;
                    $invoice->amount = 0; // Initialize the amount

                    if (is_numeric($plan->rate_per_month) && is_numeric($plan->rate_per_employee)) 
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
                $invoice->invoice_number = $invoiceNumber;
              $invoice->save();
           // Mail::to($employer->email)->send(new InvoiceEmail($invoiceDetails));
           // Mail::to($employer->email)->send(new InvoiceEmail($employer,$invoice,$plan,$total_employee_rate,$invoiceNumber));
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
    
}
