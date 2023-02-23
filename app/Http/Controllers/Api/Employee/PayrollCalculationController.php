<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use App\Http\Controllers\Employer\PayrollController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class PayrollCalculationController extends Controller
{
    public function payroll(Request $request){
        $validator = Validator::make($request->all(),[
            'employer_id' => 'required',
        ]); 

        //if validation fails
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->first(),
            ],400);
        }
        $payrollDate = Carbon::now();
            $EmployerId = $request->employer_id;
            $employees = User::where('employer_id', $EmployerId)->get();
            $today = Carbon::today()->toDateString();

            foreach($employees as $employee){         //Taking each employees 
                if($employee->pay_date != Null){
                        $payDate = $employee->pay_date;
                        $payPeriod = CarbonPeriod::since($payDate)->until($today);
                        $subPeriodLength = CarbonInterval::days(7);
                        $subPeriods = [];

                        $startDate = $payPeriod->getStartDate();

                    while ($startDate->lessThan($payPeriod->getEndDate())) {
                        $endDate = $startDate->copy()->add($subPeriodLength)->subDay(); // Subtract one day from the end date
                        $subPeriod = CarbonPeriod::since($startDate)->until($endDate);
                        $subPeriods[] = $subPeriod;
                        $startDate = $endDate->copy()->addDay(); // Add one day to the start date for the next sub-period
                    }

            foreach ($subPeriods as $week) {
                $payrollcontroller = new PayrollController;
                $fromDate = $week->getStartDate();
                $endDate = $week->getEndDate();
                $s=$payrollcontroller->generate_hourly_payroll($employee,$fromDate,$endDate);
                // $hoursWorked = $this->getHoursWorkedForWeek($employee, $week);
                // $salary = $hoursWorked * $employee->hourly_rate;
                // $totalSalary += $salary;
            }
            
            return response()->json(['message' => 'Payroll calculated successfully.']);
           
            
        
        }











                // else if($employee->payed_date != Null){
                    
                //     $employee->pay_date = Carbon::parse($employee->payed_date)->copy()->addWeek();
                //     $employee->save();
                //     $fromDate = $employee->payed_date;
                //     if($employee->pay_date == $today){
                //         $payDate = $employee->pay_date;
                //         $payrollcontroller->generate_hourly_payroll($employee,$fromDate,$payDate);
                //     }
                // }else{
                //     $employee->pay_date = Carbon::parse($employee->employment_start_date)->copy()->addWeek();
                //     $employee->save();
                //     $fromDate = $employee->employment_start_date;
                //     if($employee->pay_date == $today){
                //         $payDate = $employee->pay_date;
                //         $payrollcontroller->generate_hourly_payroll($employee,$fromDate,$payDate);
                //     }
                // }
    
            }

    }
    
}
