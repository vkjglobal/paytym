<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmployeeProject;
use App\Models\User;
use App\Models\Project;
use App\Models\Attendance;
use App\Models\Leaves;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\ProjectExpense;

use App\Models\Country;
use App\Models\AssignAllowance;
use App\Models\ProvidentFund;
use App\Models\Commission;
use App\Models\AssignDeduction;
use App\Models\Bonus;
use App\Models\Employer;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Auth;
use DB;
use Mail;

class ProjectBudgetReached extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project budget reached:reminder';
    protected $description = 'Send reminders to HR/Employer upon reaching project budget';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $projects =  Project::where('end_date','>=',$today)->where('status',1)->get();
        foreach($projects as $project)
        {
            $employees_in_project = EmployeeProject::with('user')->where('project_id',$project->id)->get();
            foreach($employees_in_project as $employees)
                {
                    $employee = $employees->user;
                    $employer = $user->employer;
                    $employerId = $user->employer_id;
                    if ($employee->salary_type == "1" && $employee->status == "1") {
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
                        $startDate = $project->start_date;
                        $endDate = $today;
                            $subPeriod = CarbonPeriod::since($startDate)->until($endDate);
                            $subPeriods[] = $subPeriod;
                            $startDate = $endDate->copy()->addDay(); // Add one day to the start date for the next sub-period
                        
                        if (count($subPeriods) > 0) {
                                    $fromDate = $project->start_date;
                                    $endDate = $today;
                                    $EmployerId =  Auth::guard('employer')->user()->id;
                                   $payDate = $today;
                                   $attendances = Attendance::where('user_id', $employee->id)->whereBetween('date', [$fromDate, $payDate])->get();
                                   if ($attendances) {
                                       $attendance_dup = $attendances;
                                       $holidays = Leaves::whereBetween('date', [$fromDate, $payDate])->get();
                           
                                       $holidayArray = $holidays->pluck('date')->toArray();
                                       $totalHours = 0;
                                       $attendancesWithoutHoliday = $attendances->reject(function ($attendance) use ($holidayArray) {
                                           return in_array($attendance->date, $holidayArray);
                                       });
                           //return $attendancesWithoutHoliday;
                                       foreach ($attendances as $attendance) {
                                           $checkIn = Carbon::parse($attendance->check_in);
                                           if ($employee->check_out_reqd == '1') {
                                               $checkOut = Carbon::parse($attendance->check_out);
                                           } else {
                                               $checkOut = Carbon::parse($employee->check_out_default);
                                           }
                                           // calculate the number of hours worked for this day
                                           $hoursWorked = $checkIn->diffInHours($checkOut);
                                           $totalHours += $hoursWorked;
                                       }
                           
                                       //Extra hours at base rate and over time rate calculation
                                       $overtimerate = optional($employee->business->payrollsetting)->over_time_rate ?? 0;
                                       if ($totalHours > $employee->total_hours_per_week) {
                                           $extraHours = $totalHours - ($employee->total_hours_per_week);
                                           if ($extraHours > $employee->extra_hours_at_base_rate) {
                                               $overTimeHours = $extraHours - $employee->extra_hours_at_base_rate;
                                               $extraOverTimeSalary = ($overTimeHours * ($employee->rate * $overtimerate));
                                               $extraBaseTimeSalary = ($employee->rate * ($employee->extra_hours_at_base_rate));
                                               $total_pay = $extraOverTimeSalary + $extraBaseTimeSalary;  //overtime salary + over time base
                                           } else {
                                               $total_pay = ($extraHours * $employee->rate); //over time base salary
                                           }
                                       }
                                       //Double time calculation
                                       $doubletimerate = optional($employee->business->payrollsetting)->double_time_rate ?? 0;
                                       foreach ($holidays as $holiday) {
                                           foreach ($attendance_dup as $attendance) {
                                               if ($attendance->date == $holiday->date) {
                                                   $TotalHolidayHours = 0;
                                                   $checkIn = Carbon::parse($attendance->check_in);
                                                   $checkOut = Carbon::parse($attendance->check_out);
                                                   $holidayHours = $checkIn->diffInHours($checkOut);
                                                   $TotalHolidayHours += $holidayHours;
                                                   $doubleTimeRate = $TotalHolidayHours * ($employee->rate * $doubletimerate);
                                               }
                                           }
                                       }
                                       $base_pay = ($employee->rate * ($employee->total_hours_per_week));
                                        $perDaySalary = ($employee->pay_period == '0') ? ($employee->rate / 7) : (($employee->pay_period == '1') ? ($employee->rate / 14) : ($employee->rate / 1));
                                        $totalEarnings = $employee->rate + ($totalHours * $attendances->count());
                        }


                }
                $daily_expense = new ProjectExpense();
                    $daily_expense->employer_id = Auth::guard('employer')->user()->id;
                    $daily_expense->project_id = $projectId;
                    $daily_expense->employee_id = $employee->id;
                    $daily_expense->date = Carbon::today()->format('Y-m-d');//$today;
                    $daily_expense->worked_hours = 8;
                    $daily_expense->expense_amount = $totalEarnings;
                    $daily_expense->employee_status = $employee->status;
                    $expense = ProjectExpense::where('project_id',$projectId)->where('employee_id',$employee->id)->get();
                    if(!$expense)
                    {
                        $daily_expense->save();
                    }
                    else
                    {
                        $expense =ProjectExpense::where('project_id',$projectId)->where('employee_id',$employee->id)->delete();
                        $daily_expense->save();
                    }
        }
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
               
                foreach ($payPeriods as $payPeriod) {
                    $salaryStartDate = $payPeriod['start_date'];
                    $salaryEndDate = $payPeriod['end_date'];
                    $fromDate = $project->start_date;
                    //$perDaySalary = ($employee->pay_period == '0') ? ($employee->rate / 7) : (($employee->pay_period == '1') ? ($employee->rate / 14) : ($employee->rate / ($fromDate->daysInMonth)));
                    $perDaySalary = ($employee->pay_period == '0') ? ($employee->rate / 7) : (($employee->pay_period == '1') ? ($employee->rate / 14) : ($employee->rate / 1));
                    $attendances = Attendance::where('user_id', $employee->id)->whereBetween('date', [$fromDate, $endDate])->get();
                    $holidays = Leaves::where('employer_id', $employee->employer_id)->whereBetween('date', [$fromDate, $endDate])->get();
                    $period = CarbonPeriod::create($fromDate, $endDate)->toArray();
                    $dates = [];
                    foreach ($period as $date) {
                        $dates[] = $date->format('Y-m-d');
                    }

                    $holidayArray = $holidays->pluck('date')->toArray();
                    $nonHolidayDates = array_diff($dates, $holidayArray);


                        $approvedLeaves  = []; // array of allowed leaves for each leave type
                        $lwop = 0;
                            foreach ($nonHolidayDates as $date) {
                                $attendance = Attendance::where('employer_id', $employee->employer_id)->where('user_id', $employee->id)->where('date', $date)->get();

                                if (count($attendance) > 0) {
                                    continue;
                                } else {
                                    $leave = $leave_request = LeaveRequest::where('user_id', $employee->id)
                                        ->where(function ($query) use ($date) {
                                            $query->where('start_date', '<=', $date)
                                                ->where('end_date', '>=', $date);
                                        })
                                        ->orWhere(function ($query) use ($date) {
                                            $query->where('start_date', '>=', $date)
                                                ->where('end_date', '<=', $date);
                                        })
                                        ->orWhere(function ($query) use ($date) {
                                            $query->where('start_date', '<=', $date)
                                                ->where('end_date', '>=', $date);
                                        })
                                        ->first();
                                    if ($leave && $leave->status == "1") {
                                        $leaveTypeId = $leave->type;
                                        if (!isset($leaveDaysTaken[$leaveTypeId])) { // If this is the first leave day for this leave type, create a new array
                                            $leaveDaysTaken[$leaveTypeId] = [];
                                        }
                                        array_push($leaveDaysTaken[$leaveTypeId], $date); // Add this leave day to the array for this leave type
                                    } else {

                                        $lwop++;
                                    }
                                }
                            }
                            if (isset($leaveDaysTaken)) {
                                foreach ($leaveDaysTaken as $leaveTypeId => $leaveDays) { // Loop through each leave type
                                    $leaveType = LeaveType::find($leaveTypeId);
                                    $leaveTypeAllowed = $leaveType->allowed_leaves;
                                    if (count($leaveDays) > $leaveTypeAllowed) { // If the employee has taken more leave days than allowed for this leave type, increase the lwop counter
                                        $lwop += count($leaveDays) - $leaveTypeAllowed;
                                    }
                                }
                            }


                                $lwopAmount = $lwop * $perDaySalary;

                                //Total salary calculation
                                $base_pay = $employee->rate;

                                //added later
                    $perDaySalary = ($employee->pay_period == '0') ? ($employee->rate / 7) : (($employee->pay_period == '1') ? ($employee->rate / 14) : ($employee->rate / 1));
                   // return $perDaySalary;
                    $totalEarnings = $attendances->count()*$perDaySalary;
                    //return $attendances->count();
                                //$totalEarnings = $base_pay + ($attendances->count()*$perDaySalary);
                                //return $totalEarnings;
                            }

               
                        }
                        $daily_expense = new ProjectExpense();
                                    $daily_expense->employer_id = Auth::guard('employer')->user()->id;
                                    $daily_expense->project_id = $projectId;
                                    $daily_expense->employee_id = $employee->id;
                                    $daily_expense->date = Carbon::today()->format('Y-m-d');//$today;
                                    $daily_expense->worked_hours = 8;
                                    $daily_expense->expense_amount = $totalEarnings;
                                    $daily_expense->employee_status = $employee->status;
                                // $daily_expense->save();
                                $expense = ProjectExpense::where('project_id',$projectId)->where('employee_id',$employee->id)->get();
                                if(!$expense)
                                {
                                    $daily_expense->save();
                                }
                                else
                                {
                                    $expense =ProjectExpense::where('project_id',$projectId)->where('employee_id',$employee->id)->delete();
                                    $daily_expense->save();
                                }
                    }
    }
    $expense = ProjectExpense::where('project_id',$projectId)->get();
    $total_expense_amount = 0;
    $total_expense_amount = ProjectExpense::where('project_id', $projectId)
    ->whereDate('created_at', '<=', $today)
    ->sum('expense_amount');
    $project_budget = $project->budget;
    $remaining_budget = $project_budget - $total_expense_amount;
    if($project_budget == $total_expense_amount)
    {
        Mail::to($employer->email)->send(new ProjectBudgetReachedReminderMail($employer,$project));
    }
}
        
        return Command::SUCCESS;
    }
}
