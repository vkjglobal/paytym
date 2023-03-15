<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\EmployeeCredentialsMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;



class SendLoginCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:login_credentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For sending employee credentials on the emloyement start date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $employees = User::where('status','0')->get();
        foreach($employees as $employee){
            if($employee->employment_start_date <= $today ){
                $password =  Str::random(8);
                $email = new EmployeeCredentialsMail($employee,$password);
                try{
                    Mail::to($employee->email)->send($email);
                }
                catch(Exception $e){
                    return Command::FAILURE;
                }
                $employee->password = Hash::make($password);
                $employee->status = "1";
                $issave = $employee->save();
            }
        }
        return Command::SUCCESS;
    }
}
