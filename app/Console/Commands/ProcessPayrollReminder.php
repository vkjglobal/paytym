<?php

namespace App\Console\Commands;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Mail\ProcessPayrollReminderMail;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Mail;

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
        
        $users =  User::where('status',1)->get();

        foreach ($users as $user) {
            $lastPayroll = $user->payrolls()->latest('created_at')->first();
            $employer = $user->employer;
            $employerId = $user->employer_id;
            
            //dd($employer);
            if ($lastPayroll) {
                $nextPayDate = $this->calculateNextPayDate($user->pay_period, $lastPayroll->created_at);

                // Check if the next pay date is today
                if ($nextPayDate->isToday()) {

                    $hr = User::join('roles', 'users.position', '=', 'roles.id')
                    ->where('users.employer_id', $employerId)
                    ->where('users.status', 1)
                    ->where('roles.role_name', 'like', '%HR%')
                    ->get();
                    
                    $emails = $hr->pluck('email');
                            $recipients = $emails->toArray();
                            if ($emails->count()>0) {
                                Mail::to($recipients)
                                ->cc($employer->email)
                                ->send(new ProcessPayrollReminderMail($employer,$user,$user->pay_period));
                                } 
                                else{
                                    Mail::to($employer->email)->send(new ProcessPayrollReminderMail($employer,$user,$user->pay_period));
                                    } 
                                }
                            
                   // Notification::send($user->employer, new PayrollReminderNotification($user));
                }
            }
        

       // $this->info('Payroll reminders sent successfully.');
        
        
        
        
       /*  $payrolls = Payroll::where('end_date', now()->subDay())->get();
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
                else
                {
                    $nextpayrolldate = $currentDate;
                }
                
            }

            // Notify the employer
            //Notification::send($employer, new PayrollReminderNotification($payroll));
        } */
        //return Command::SUCCESS;
    }

    private function calculateNextPayDate($payPeriod, $lastPayDate)
    {
        $lastPayDate = Carbon::parse($lastPayDate);

        switch ($payPeriod) {
            case '0':
                return $lastPayDate->addWeek();
            case '1':
                return $lastPayDate->addWeeks(2);
            case '2':
                return $lastPayDate->addMonth();
            default:
                return $lastPayDate;
        }
    
    }
}
