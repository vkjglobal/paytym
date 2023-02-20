<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Employer\PayrollController;
use App\Models\User;
use Carbon\Carbon;

class FixedPayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:fixed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calculation of payroll of employees with fixed paytype';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = User::where('pay_type','0')->where('employer_id', Auth::guard('employer')->user()->id)->get();
        $today = Carbon::today()->toDateString();
        foreach($employees as $employee){
            $payrollcontroller = new PayrollController;
            $pay_period = $employee->pay_period;


            if($employee->pay_date != Null){    
                if($employee->pay_date == $today){
                    $paydate = $employee->pay_date;
                    if($employee->last_payed_date != Null){
                        $from_date = $employee->last_payed_date;
                    } else{
                        $from_date = $employee->start_employment_date;
                    }
                    $payrollcontroller->generate_fixed_payroll($employee,$paydate,$from_date);

                }
            }else if($employee->last_payed_date != Null){    //If last payed date is present
                        if($employee->pay_period == 0 ){  //Weekly
                        $employee->pay_date = $employee->last_payed_date->copy()->addWeek();
                        $employee->save();
                        }else if($employee->pay_period == 1 ){  //Fortnightly
                        $employee->pay_date = $employee->last_payed_date->copy()->addWeek(2);
                        $employee->save();
                        }else if($employee->pay_period == 2 ){  //Monthly
                        $employee->pay_date = $employee->last_payed_date->copy()->addMonth();
                        $employee->save();
                        }
                        $paydate = $employee->pay_date;
                        $from_date= $employee->last_payed_date;
                        if($paydate == $today){
                                $payrollcontroller->generate_fixed_payroll($employee,$paydate,$from_date);
                        }
            }else{
                    if($employee->pay_period == 0 ){  //Weekly
                        $employee->pay_date = $employee->employement_start_date->copy()->addWeek();
                        $employee->save();
                    }else if($employee->pay_period == 1 ){  //Fortnightly
                        $employee->pay_date = $employee->employment_start_date->copy()->addWeek(2);
                        $employee->save();
                    }else if($employee->pay_period == 2 ){  //Monthly
                        $employee->pay_date = $employee->employment_start_date->copy()->addMonth();
                        $employee->save();
                    }
                    $paydate = $employee->pay_date;
                    $from_date = $employee->employment_start_date;
                        if($paydate == $today){
                                $payrollcontroller->generate_fixed_payroll($employee,$paydate,$from_date);
                        }
                    
                }


            }
            
        

        
        return Command::SUCCESS;
    }
}
