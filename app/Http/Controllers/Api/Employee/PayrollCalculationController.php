<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use App\Http\Controllers\Employer\PayrollController;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class PayrollCalculationController extends Controller
{
    public function payroll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' => 'required',
            // 'payroll_status' => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $payroll_status = $request->payroll_status;
        if ($payroll_status == '0') {
            $payroll=Payroll::where('employer_id', $request->employer_id)
            ->update(['payroll_status' => $request->payroll_status]);

            return response()->json([
                'message' => "Disabled",
            ], 200);

        }

        $EmployerId = $request->employer_id;
        $employees = User::where('employer_id', $EmployerId)->get();
        $today = Carbon::today();
        foreach ($employees as $employee) {
            if ($employee->salary_type == "1") {

                //Taking each employees 
                if ($employee->payed_date != Null) {
                    $LastPayedDate = $employee->payed_date;
                } else {
                    $LastPayedDate = $employee->employment_start_date;
                }
                $payPeriod = CarbonPeriod::since($LastPayedDate)->until($today);
                if ($employee->pay_period == "1") {
                    $subPeriodLength = CarbonInterval::days(14);
                } else {
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

                    if ($employee->pay_period == "1") {
                        if (count($week) < 14) {
                            break;
                        }
                    } else {
                        if (count($week) < 7) {
                            break;
                        }
                    }

                    $payrollcontroller = new PayrollController;
                    $fromDate = $week->getStartDate();
                    $endDate = $week->getEndDate();
                    $s = $payrollcontroller->generate_hourly_payroll($employee, $fromDate, $endDate);
                    $LastPayedDate = $endDate;
                }
                $employee->payed_date = $LastPayedDate;
                $employee->save();
            }
            //Fixed salary type
            else if ($employee->salary_type == "0") {
                $lastPayedDate = $employee->payed_date ?? $employee->employment_start_date;
                switch ($employee->pay_period) {
                    case 0:
                        $frequencyType = 'weekly';
                        $payPeriodLength = '1 week';
                        break;
                    case 1:
                        $frequencyType = 'fortnightly';
                        $payPeriodLength = '2 weeks';
                        break;
                    case 2:
                        $frequencyType = 'monthly';
                        $payPeriodLength = '1 month';
                        break;
                    default:
                        throw new Exception('Invalid salary type');
                }

                // Calculate number of pay periods to process
                $now = Carbon::now();
                $payPeriods = [];
                $lastPayedDate = Carbon::parse($lastPayedDate);
                $startDate = $lastPayedDate->copy()->addDay();  // start with next day after last paid date
                while ($startDate < $now) {
                    if ($frequencyType == 'monthly') {
                        $endDate = $startDate->copy()->endOfMonth();
                    } else if ($frequencyType == 'weekly') {
                        $endDate = $startDate->copy()->addWeek();
                    } else {
                        $endDate = $startDate->copy()->addWeek(2);
                    }
                    // $nowMonth = $now->month;
                    // $endDateMonth = $endDate->month;
                    // if($nowMonth != $endDateMonth){
                    $payPeriods[] = ['start_date' => $startDate, 'end_date' => $endDate];
                    $startDate = $endDate->copy()->addDay(); // start next pay period with next day after end date
                    // }
                }
                $lastPayPeriod = end($payPeriods);
                if (count($payPeriods) != 0) {
                    if (($now->toDateString()) < $lastPayPeriod['end_date']) {
                        array_pop($payPeriods);
                    }
                    foreach ($payPeriods as $payPeriod) {
                        $salaryStartDate = $payPeriod['start_date'];
                        $salaryEndDate = $payPeriod['end_date'];
                        $payrollcontroller = new PayrollController;
                        return($payrollcontroller->generate_fixed_payroll($employee, $salaryStartDate, $salaryEndDate));
                    }


                    $employee->payed_date = $salaryEndDate;

                    $employee->save();
                }

                // Calculate payroll for each pay period

            }
        }
        return response()->json([
            'message' => 'Payroll calculated successfully.',
        ]);
    }
}
