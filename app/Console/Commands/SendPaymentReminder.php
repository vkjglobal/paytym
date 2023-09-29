<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Employer;
use App\Models\Invoice;
use App\Models\BillingEmail;
use App\Mail\PaymentReminderEmail;
use App\Mail\AccountDeactivationWarningEmail;
use Illuminate\Support\Facades\Mail;

class SendPaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:payment-reminder';
    protected $description = 'Send payment reminder emails on the 6th of every month';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $sixthOfMonth = $today->copy()->day(6);

        // Send payment reminder emails
        if ($today->isSameDay($sixthOfMonth)) {
            //$employersWithPendingPayments = Employer::with('invoice')->where('status', '0')->get();
            $employersWithPendingPayments = Employer::where('status', '1') 
            ->whereHas('invoice', function ($query) {
                $query->where('status', '0'); // Invoice status is 0
            })
            ->get();
            foreach ($employersWithPendingPayments as $employer) {
                $invoice = Invoice::where('employer_id',$employer->id)->where('status','0')->latest()->first();
                $billingEmails = BillingEmail::where('employer_id',$employer->id)->pluck('email');
                if ($billingEmails->isEmpty()) {
                    Mail::to($employer->email)->send(new PaymentReminderEmail($employer,$invoice));
                }
                else{
                    $recipients = $billingEmails->toArray();
                    Mail::to($employer->email)
                    ->cc($recipients)
                    ->send(new PaymentReminderEmail($employer,$invoice));
                   /* $recipients = collect([$employer->email])->concat($billingEmails);
                    Mail::to($recipients->toArray())->send(new PaymentReminderEmail($employer));*/

                }
                $employer->invoice->where('status', '0')->each(function ($invoice) {
                    $invoice->update(['status' => '2']); // Set status to '2' (overdue)
                });
            }
        }

        // Send account deactivation warning emails 48 hours before deactivation
       /*  if ($today->isSameDay($sixthOfMonth->copy()->addDays(2))) {
            $employersToDeactivate = Employer::where('payment_status', 'pending')->get();

            foreach ($employersToDeactivate as $employer) {
                Mail::to($employer->email)->send(new AccountDeactivationWarningEmail($employer));
            }
        } */
        //return Command::SUCCESS;
    }
}
