<?php

namespace App\Http\Controllers\Api\Employee;

use App\Exports\Employer\PaymentExport;
use App\Exports\Employer\MpaisaExport;
use App\Exports\Employer\MycashExport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use App\Http\Controllers\Employer\PayrollController;
use App\Models\Employer;
use App\Models\Payroll;
use App\Models\LeaveRequest;
use App\Models\Overtime;
use App\Models\SplitPayment;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PayrollCalculationController extends Controller
{
    public function payroll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' => 'required',
            // 'payroll_status' => 'required',
        ]);
        $flag_payroll = 0;
        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $EmployerId = $request->employer_id;




        $employees = User::where('employer_id', $EmployerId)->get();


        //Checking for pending approval or rejection leaves , attendance or overtime
        $pending_leaves = LeaveRequest::where('employer_id', $request->employer_id)->where('status', '0')->get();
        $pending_overtime = Overtime::where('employer_id', $request->employer_id)->where('status', '0')->get();
        $pending_attendance = Attendance::where('employer_id', $request->employer_id)->where('approve_reject', null)->get();

        if ((count($pending_leaves) > 0)) {
            return response()->json([
                'message' => 'There is pending leave requests'
            ], 400);
        }
        if ((count($pending_overtime) > 0)) {
            return response()->json([
                'message' => 'There is pending overtime requests'
            ], 400);
        }
        if ((count($pending_attendance) > 0)) {
            return response()->json([
                'message' => 'There is pending attendance approvals'
            ], 400);
        }



        $today = Carbon::today();

        foreach ($employees as $employee) {
            if ($employee->salary_type == "1" && $employee->status == "1") {
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
                if (count($subPeriods) > 0) {
                    $flag = 0;
                    foreach ($subPeriods as $week) {

                        if ($employee->pay_period == "1") {
                            if (count($week) < 14) {
                                $flag = 1;
                                break;
                            }
                        } else {
                            if (count($week) < 7) {
                                $flag = 1;
                                break;
                            }
                        }
                        if ($flag == 0) {
                            $payrollcontroller = new PayrollController;
                            $fromDate = $week->getStartDate();
                            $endDate = $week->getEndDate();

                            $payrollcontroller->generate_hourly_payroll($employee, $fromDate, $endDate, $EmployerId);
                            $salaryEndDate = $endDate;
                            $employee->payed_date = $salaryEndDate;
                            $employee->save();
                        }
                    }
                }
            }
            //Fixed salary type
            else if ($employee->salary_type == "0" && $employee->status == "1") {

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
                        $endDate = $startDate->copy()->addWeek()->subDay();
                    } else {
                        $endDate = $startDate->copy()->addWeek(2);
                    }
                    // $nowMonth = $now->month;
                    // $endDateMonth = $endDate->month;
                    // if($nowMonth != $endDateMonth){
                    $payPeriods[] = ['start_date' => $startDate, 'end_date' => $endDate];
                    $startDate = $endDate->copy()->addDay(); // start next pay period with next day after end date
                }
                $lastPayPeriod = end($payPeriods);
                if (count($payPeriods) != 0) {
                    //     if (($now->toDateString()) < $lastPayPeriod['end_date']) {
                    //         array_pop($payPeriods);
                    //     }
                    //   dd($payPeriods);
                    foreach ($payPeriods as $payPeriod) {
                        $salaryStartDate = $payPeriod['start_date'];
                        $salaryEndDate = $payPeriod['end_date'];
                        $payrollcontroller = new PayrollController;
                        $payrollcontroller->generate_fixed_payroll($employee, $salaryStartDate, $salaryEndDate, $EmployerId);
                    }

                    if (isset($salaryEndDate)) {
                        $employee->payed_date = $salaryEndDate;
                    }
                    $employee->save();
                }
            }
        }

        // Comented by robin on 14-06-23   it is needed. 
        // $hr = User::with('role')->where('employer_id', $EmployerId)->where('role_name','like', '%hr%')->first();

        //sending payroll csv file through email bank
        // $export = new PaymentExport();
        // $store = Storage::put('exports/payroll.csv', Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        // $path = 'exports/payroll.csv';
        // Mail::send([], [], function ($message) use ($path, $EmployerId) {
        //    // $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
        //    $hr = Role::with('user')->where('employer_id', $EmployerId)->where('role_name','like', '%hr%')->first();

        //     //$finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
        //     $finance = Role::with('user')->where('employer_id', $EmployerId)->where('role_name','like', '%finance%')->first();
        //     if($finance == null){
        //         $to = [$hr->user->email];
        //     }elseif($hr == null){
        //         $to = [$finance->user->email];
        //     }elseif($finance == null && $hr == null){
        //         $employer = Employer::where('employer_id', $EmployerId)->first();
        //         $to = $employer->email;
        //     }else{
        //         $to = [$hr->user->email, $finance->user->email];
        //     }
        //     $message->to($to)
        //             ->subject('Payroll csv file created on:'.Carbon::today()->format('d-m-Y'))
        //             ->attach(Storage::path($path), [
        //                 'as' => 'bank.csv',
        //                 'mime' => 'text/csv'
        //             ]);
        // });
        // Storage::delete($path); 


        //sending payroll csv file through email mpaisa
        // $export = new MpaisaExport();
        // $store = Storage::put('exports/payroll.csv', Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        // $path = 'exports/payroll.csv';
        // Mail::send([], [], function ($message) use ($path, $EmployerId) {
        //     $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
        //     $finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
        //     if($finance == null){
        //         $to = [$hr->email];
        //     }elseif($hr == null){
        //         $to = [$finance->email];
        //     }elseif($finance == null && $hr == null){
        //         $employer = Employer::where('employer_id', $EmployerId)->first();
        //         $to = $employer->email;
        //     }else{
        //         $to = [$hr->email, $finance->email];
        //     }
        //     $message->to($to)
        //             ->subject('Payroll csv file created on:'.Carbon::today()->format('d-m-Y'))
        //             ->attach(Storage::path($path), [
        //                 'as' => 'mpaisa.csv',
        //                 'mime' => 'text/csv'
        //             ]);
        // });
        // Storage::delete($path); 



        //end sending

        //sending payroll csv file through email mycash
        // $export = new MycashExport();
        // $store = Storage::put('exports/payroll.csv', Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        // $path = 'exports/payroll.csv';
        // Mail::send([], [], function ($message) use ($path, $EmployerId) {
        //     $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
        //     $finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
        //     if($finance == null){
        //         $to = [$hr->email];
        //     }elseif($hr == null){
        //         $to = [$finance->email];
        //     }elseif($finance == null && $hr == null){
        //         $employer = Employer::where('employer_id', $EmployerId)->first();
        //         $to = $employer->email;
        //     }else{
        //         $to = [$hr->email, $finance->email];
        //     }
        //     $message->to($to)
        //             ->subject('Payroll csv file created on:'.Carbon::today()->format('d-m-Y'))
        //             ->attach(Storage::path($path), [
        //                 'as' => 'mycash.csv',
        //                 'mime' => 'text/csv'
        //             ]);
        // });
        // Storage::delete($path); 

        return response()->json([
            'message' => 'Payroll calculated successfully.',
        ]);
        // if($flag_payroll==1)
        // {

        // }
        // else{
        //     return response()->json([
        //         'message' => 'All Employees PayRoll Already Calculated.',
        //     ]);
        // }

    }
}