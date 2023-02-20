<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Employer\PayrollController;
use App\Models\User;
use Carbon\Carbon;

class CalculatePayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For calculating payroll for employees';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $employees = User::where('pay_type','1')->where('employer_id', Auth::guard('employer')->user()->id)->get();
        $today = Carbon::today()->toDateString();
        foreach($employees as $employee){
            $payrollcontroller = new PayrollController;
            if($employee->pay_date != Null){
                if($employee->pay_date == $today){
                    $payDate = $employee->pay_date;
                    $payrollcontroller->generate_hourly_payroll($payDate);
                }
                
            }else if($employee->last_pay_date != Null){
                $employee->pay_date = $employee->last_pay_date->copy()->addWeek();
                $employee->save();
                if($employee->pay_date == $today){
                    $payDate = $employee->pay_date;
                    $payrollcontroller->generate_hourly_payroll($employee,$payDate);
                }
            }else{
                $employee->pay_date = $employee->start_date->copy()->addWeek();
                $employee->save();
                if($employee->pay_date == $today){
                    $payDate = $employee->pay_date;
                    $payrollcontroller->generate_hourly_payroll($employee,$payDate);
                }
            }

        }
    }
}
