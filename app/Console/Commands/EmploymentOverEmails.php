<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeTerminationEmail;
use App\Mail\EmploymentOver;
use Illuminate\Support\Carbon;

class EmploymentOverEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:employment-over-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send email to HR when an employees employment period is over';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = User::where('employer_id', Auth::guard('employer')->id())->where('employment_end_date', '=', Carbon::now())->get();
        $hr = User::where('employer_id', Auth::guard('employer')->id())->where('position', '=', '1')->first();
        foreach ($employees as $employee) {
            $email = new EmploymentOver($employee);

            Mail::to($hr->email)->send($email);
        }
    }
}
