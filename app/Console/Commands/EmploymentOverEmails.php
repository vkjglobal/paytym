<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmploymentOver;
use Exception;
use Illuminate\Support\Carbon;

class EmploymentOverEmails extends Command
{

    protected $signature = 'send:employment-over-email';


    protected $description = 'Command to send email to HR when an employees employment period is over';


    public function handle()
    {
        
        $employees = User::where('employment_end_date', 'like', Carbon::tomorrow()->format('Y-m-d'))->get();
        // $hr = User::where('position', '1')->where('employer_id', Auth::guard('employer')->id());
        
        foreach ($employees as $employee) {
            $hr = User::where('position', '1')->where('employer_id', $employee->employer_id)->first();
            $email = new EmploymentOver($employee);
            try{
                Mail::to($hr->email)->send($email);
            }
            catch(Exception $e){
                return Command::FAILURE;
            }
            
        }
    }
}
