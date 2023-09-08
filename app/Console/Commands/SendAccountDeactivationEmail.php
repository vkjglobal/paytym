<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Employer;
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
        $sixthOfMonth = $today->copy()->day(8);
        if ($today->isSameDay($sixthOfMonth)){//(now()->day == 7) {
            // Fetch users/accounts to be deactivated
            $employersWithOverduePayments = Employer::where('status', '1') 
            ->whereHas('invoice', function ($query) {
                $query->where('status', '2'); // Invoice status is overdue
            })
            ->get();

            foreach ($employersWithOverduePayments as $employer) {
                $user = Employer::where('email','=',$employer->email)->update(['status' => '0']);
                
                Mail::to($employer->email)->send(new AccountDeactivationEmail($employer));
                //$employer->update(['status' => '0']);
            }

           // $this->info('Account deactivation emails sent successfully.');
        }
        //return Command::SUCCESS;
    }
}
