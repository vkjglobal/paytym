<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;  
use App\Http\Controllers\Employer\PayrollController;
class HourlyPayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calculate payrolls of employees with hourly pay type';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = User::where('salary_type','1')->get();
        $today = Carbon::today()->toDateString();
        foreach($employees as $employee){
            $payrollcontroller = new PayrollController;
            if($employee->pay_date != Null){
                if($employee->pay_date == $today){
                    $payDate = $employee->pay_date;
                    if($employee->payed_date != Null){
                        $fromDate = $employee->payed_date ;
                    }else{
                        $fromDate = $employee->employment_start_date;
                    }
                    $payrollcontroller->generate_hourly_payroll($employee,$fromDate,$payDate);
                }
            }
            else if($employee->payed_date != Null){
                
                $employee->pay_date = Carbon::parse($employee->payed_date)->copy()->addWeek();
                $employee->save();
                $fromDate = $employee->payed_date;
                if($employee->pay_date == $today){
                    $payDate = $employee->pay_date;
                    $payrollcontroller->generate_hourly_payroll($employee,$fromDate,$payDate);
                }
            }else{
                $employee->pay_date = Carbon::parse($employee->employment_start_date)->copy()->addWeek();
                $employee->save();
                $fromDate = $employee->employment_start_date;
                if($employee->pay_date == $today){
                    $payDate = $employee->pay_date;
                    $payrollcontroller->generate_hourly_payroll($employee,$fromDate,$payDate);
                }
            }

        }
        return Command::SUCCESS;
    }
}
