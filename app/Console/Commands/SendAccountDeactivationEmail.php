<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Employer;
use App\Models\BillingEmail;
use App\Mail\PaymentReminderEmail;
use App\Mail\AccountDeactivationEmail;
use App\Mail\AccountDeactivationWarningEmail;
use Illuminate\Support\Facades\Mail;

class SendAccountDeactivationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:account-deactivation';
    protected $description = 'Send account deactivation email on the 8th day of the month';

    /**
     * The console command description.
     *
     * @var string
     */
   // protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $sixthOfMonth = $today->copy()->day(12);
        if ($today->isSameDay($sixthOfMonth)){//(now()->day == 7) {
            // Fetch users/accounts to be deactivated
            $employersWithOverduePayments = Employer::where('status', '1') 
            ->whereHas('invoice', function ($query) {
                $query->where('status', '2'); // Invoice status is overdue
            })
            ->get();

            foreach ($employersWithOverduePayments as $employer) {
                $user = Employer::where('email','=',$employer->email)->update(['status' => '0']);
                $billingEmails = BillingEmail::where('employer_id',$employer->id)->pluck('email');
                if ($billingEmails->isEmpty()) {
                Mail::to($employer->email)->send(new AccountDeactivationEmail($employer));
                }
                else
                {
                    $recipients = $billingEmails->toArray();
                    Mail::to($employer->email)
                    ->cc($recipients)
                    ->send(new AccountDeactivationEmail($employer));
                    /*$recipients = collect([$employer->email])->concat($billingEmails);
                    Mail::to($recipients->toArray())->send(new AccountDeactivationEmail($employer));*/
                }
                //$employer->update(['status' => '0']);
            }

           // $this->info('Account deactivation emails sent successfully.');
        }
        //return Command::SUCCESS;
    }
}
