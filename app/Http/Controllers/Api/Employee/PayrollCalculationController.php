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
            $EmployerId = $request->employer_id;
            $employees = User::where('employer_id', $EmployerId)->get();
            $today = Carbon::today();
            foreach($employees as $employee){
                if($employee->salary_type == "1"){

                       //Taking each employees 
                if($employee->payed_date != Null){  
                        $LastPayedDate = $employee->payed_date;

                }else{
                    $LastPayedDate = $employee->employment_start_date;
                }
                        $payPeriod = CarbonPeriod::since($LastPayedDate)->until($today);
                        if($employee->pay_period == "1"){
                            $subPeriodLength = CarbonInterval::days(14);
                        }else{
                            $subPeriodLength = CarbonInterval::days(7);
                        }
                        
                        $subPeriods = [];
                        
                        $startDate = $payPeriod->getStartDate();

                    while ($startDate->lessThan($payPeriod->getEndDate())) {
                        $endDate = $startDate->copy()->add($subPeriodLength)->subDay(); // Subtract one day from the end date
                        if ($endDate->gt($today)) {
                            $endDate = $today->copy(); // Adjust the end date to be equal to today's date
                        }
                        $subPeriod = CarbonPeriod::since($startDate)->until($endDate);
                        $subPeriods[] = $subPeriod;
                        $startDate = $endDate->copy()->addDay(); // Add one day to the start date for the next sub-period
                    } 
            foreach ($subPeriods as $week) {

                if($employee->pay_period == "1"){
                    if(count($week) < 14){
                        break;
                    }
                    }else{
                        if(count($week) < 7){
                            break;
                        }
                    }
                
                $payrollcontroller = new PayrollController;
                $fromDate = $week->getStartDate();
                $endDate = $week->getEndDate();
                $s=$payrollcontroller->generate_hourly_payroll($employee,$fromDate,$endDate);
                $LastPayedDate = $endDate;
                
            }
            $employee->payed_date = $LastPayedDate;
            $employee->save();          
           }
           
        }
        return response()->json(['message' => 'Payroll calculated successfully.']);



        
    // For fixed salary type

    // if($employee->salary_type == "0"){
    //     if($employee->payed_date != Null){
    //         $LastPayedDate = Carbon::parse($employee->payed_date);
    //     }else{
    //         $LastPayedDate = Carbon::parse($employee->start_date);
    //     }
    //     $payPeriod = CarbonPeriod::since($LastPayedDate)->until($today);
    //     // return($payPeriod );
    //     // Split the pay period into smaller periods based on frequency
    //     if ($employee->pay_period == '2') {
    //         $subPeriods = $payPeriod->split(CarbonInterval::divide(2));
    //         // $LastPayedDate = Carbon::parse($LastPayedDate);
    //         // $period = $LastPayedDate->diffInMonths($today);
    //         return($subPeriods );

            

    //     } else if($employee->pay_period === '1') {
    //         $subPeriods = $payPeriod->split(CarbonInterval::weeks(2));
    //     } else{
    //         $subPeriods = $payPeriod->split(CarbonInterval::weeks(1));
    //     }

    //     // Calculate payroll for each sub period
    //     foreach ($subPeriods as $subPeriod) {
    //         $startDate = $subPeriod->getStartDate();
    //         $endDate = $subPeriod->getEndDate();

    //         // Calculate payroll for this sub period
    //         $s = $payrollcontroller->generate_fixed_payroll($employee,$fromDate,$endDate);
    //     }

    // }

    
            

    }
    
}
