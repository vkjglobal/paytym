<?php

namespace App\Console\Commands;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PayrollReminderNotification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ProcessPayrollReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'command:name';
    protected $signature = 'payroll:reminder';
    protected $description = 'Send reminders to HR/Employer to process payroll';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $payrolls = Payroll::where('end_date', now()->subDay())->get();
        foreach ($payrolls as $payroll) {
            // Assuming you have a relationship between Payrolls and Users
            $employer = $payroll->employer;
            $users = User::where('employer_id',$employer->id)->where('status',1)->get();
            $currentDate = Carbon::now();
            $nextpayrolldate = "";

            foreach($users as $user)
            {
                if($user->pay_period == 0)
                {
                    $nextpayrolldate = $currentDate->addDays(7);
                }
                elseif($user->payperiod == 1)
                {
                    $nextpayrolldate = $currentDate->addDays(15);
                }
                elseif($user->payperiod == 1)
                {
                    $nextpayrolldate = $currentDate->addDays(30);
                }
                
            }

            // Notify the employer
            //Notification::send($employer, new PayrollReminderNotification($payroll));
        }
        //return Command::SUCCESS;
    }
}
