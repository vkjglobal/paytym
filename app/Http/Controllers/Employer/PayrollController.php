<?php

namespace App\Http\Controllers\Employer;

use App\Exports\Employer\PaymentExport;
use App\Http\Controllers\Api\Employee\PayrollCalculationController;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Country;
use App\Models\Attendance;
use App\Models\AssignAllowance;
use App\Models\ProvidentFund;
use App\Models\Leaves;
use App\Models\LeaveType;
use App\Models\LeaveRequest;
use App\Models\Commission;
use App\Models\AssignDeduction;
use App\Models\Bonus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Jobs\PayslipGeneration;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employer;
use App\Models\EmployerBusiness;
use App\Models\TaxSettings;
use App\Models\TaxSettingsSrtModel;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $payrolls = Payroll::where('employer_id',Auth::guard('employer')->user()->id)->get();
        // return view('employer.Payroll.index', compact('payrolls'));
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Payroll')), null],
        ];
        $payrolls = Payroll::where('employer_id', Auth::guard('employer')->user()->id)->latest()->get();

        return view('employer.Payroll.index', compact('breadcrumbs', 'payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('employer.Payroll.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pay = new Payroll();
        $pay->user_id = $request->name;
        $pay->salary = $request->salary;
        $pay->paid_salary = $request->paid_salary;
        $pay->fund_deduction = $request->fund_deduction;
        $pay->p_tax = $request->p_tax;
        $pay->total_deduction = $request->total_deduction;

        if ($request->hasFile('slip')) {
            $path =  $request->file('slip')->storeAs(
                'payroll/slips',
                urlencode(time()) . '_' . uniqid() . '_' . $request->slip->getClientOriginalName(),
                'public'
            );
            $pay->pay_slip = $path;
        }

        $res = $pay->save();

        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Payroll::find($id);
        return view('employer.Payroll.payslip', compact('res'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payroll = Payroll::find($id);

        return view('employer.Payroll.edit', compact('payroll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generate_form()
    {
        $employer_id = Auth::guard('employer')->user()->id;
        $users = User::where('employer_id', $employer_id)->where('status', 1)->get();
        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $branches = Branch::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $departments = Department::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $payrolls = Payroll::where('employer_id', Auth::guard('employer')->user()->id)->latest()->get();
        return view('employer.Payroll.generate', compact('users', 'businesses', 'branches', 'departments', 'payrolls'));
    }


    public function revert_form()
    {
        $payrolls = Payroll::where('employer_id', Auth::guard('employer')->user()->id)->latest()->get();

        return view('employer.Payroll.revert', compact('payrolls'));
    }

    public function generate_hourly_payroll($employee, $fromDate, $payDate, $EmployerId)
    {
        $endDate = $payDate;
        // Check How many day the employee present during the Period
        $attendances = Attendance::where('user_id', $employee->id)->whereBetween('date', [$fromDate, $payDate])->get();
        if ($attendances) {
            $attendance_dup = $attendances;
            //Check the Leaves involved in that period. 
            $holidays = Leaves::whereBetween('date', [$fromDate, $payDate])->get();

            $holidayArray = $holidays->pluck('date')->toArray();
            $totalHours = 0;
            // Get the Real attendance count [attendance=]
            $attendancesWithoutHoliday = $attendances->reject(function ($attendance) use ($holidayArray) {
                return in_array($attendance->date, $holidayArray);
            });


            foreach ($attendances as $attendance) {
                $checkIn = Carbon::parse($attendance->check_in);

                // Have some condition based on the client new suggessions
                //1. Default time, 2. Roster 3. Checkout 
                if ($employee->check_out_reqd == '1') {
                    $checkOut = Carbon::parse($attendance->check_out);
                } else {
                    $checkOut = Carbon::parse($employee->check_out_default);
                }
                //        $checkOut = Carbon::parse($attendance->check_out);
                // calculate the number of hours worked for this day
                $hoursWorked = $checkIn->diffInHours($checkOut);
                $totalHours += $hoursWorked;
            }


            //Extra hours at base rate and over time rate calculation
            $overtimerate = optional($employee->business->payrollsetting)->over_time_rate ?? 0;
            $overtime_unit_rate = $overtimerate;
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
            $doubletime_unit_rate = $doubletimerate;
            $doubleTimeRate = 0;
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
            //Allowance Calculation
            $allowances = AssignAllowance::where('user_id', $employee->id)->get();
            $totalAllowance = 0;
            if (isset($allowances)) {
                foreach ($allowances as $allowance) {
                    $totalAllowance += $allowance->rate;
                }
            }



            //Deduction Calculation
            $totalDeduction = 0;
            $deductions = AssignDeduction::where('user_id', $employee->id)->get();
            if (isset($deductions)) {
                foreach ($deductions as $deduction) {
                    $totalDeduction += ($employee->rate * ($deduction->rate / 100));
                }
            }


            //Commissions Calculation
            $commission_amount = 0;
            $commission = Commission::where('user_id', $employee->id)->first();
            if (isset($commission)) {
                $commission_amount += $commission->rate;
            }

            //Bonus calculation
            $bonuses = Bonus::where('employer_id', $employee->employer_id)->get();
            $total_bonus = 0;
            foreach ($bonuses as $bonus) {
                if ($bonus->type == 0 && $employee->id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus = ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else if ($bonus->type == 1 && $employee->department_id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus = ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else if ($bonus->type == 2 && $employee->branch_id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus = ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else if ($bonus->type == 3 && $employee->business_id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus = ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else {
                    continue;
                }
            }


            //Tax Calculation - Income tax 
            $IncomeTaxToWithhold = 0;
            //      $taxRate = $employee->country?->tax ?? 0 ;
            //  dd($employee->total_hours_per_week);
            $weeklySalary = $employee->rate * $employee->total_hours_per_week;
            //    dd($employee->pay_period);
            if ($employee->pay_period == "0") {
                $annualIncome = $weeklySalary * 52;
                $F = 52;
            } else {
                $annualIncome = $weeklySalary * 26;
                $F =  26;    //C1
            }


            $employer = Employer::find($EmployerId)->first();
            $taxRates = TaxSettings::where('country_id', $employer->country_id)->get();
            $taxRate = 0;
            $taxAddon = 0;
            $srtRate = 0;
            $srtAddon = 0;
            $flag = 0;
            $range_from = 0;
            // foreach ($taxRates as $key => $value) {
            //     if ($value['annualincome_from'] == '0' && $annualIncome < $value['annualincome_to']) {
            //         $taxRate = $value['income_tax_rate'];
            //         $taxAddon = $value['income_tax_value'];
            //         $flag = 1;
            //     } else if ($value['annualincome_to'] == null && $annualIncome > $value['annualincome_from']) {
            //         $taxRate = $value['income_tax_rate'];
            //         $taxAddon = $value['income_tax_value'];
            //         $flag = 2;
            //     } else if ($annualIncome > $value['annualincome_from'] && $annualIncome < $value['annualincome_to']) {
            //         $taxRate = $value['income_tax_rate'];
            //         $taxAddon = $value['income_tax_value'];
            //         $flag = 3;
            //     }
            // }

            foreach ($taxRates as $key => $value) {
                if ($value['annualincome_from'] == '0' && $annualIncome < $value['annualincome_to']) {  // Low Level   0 - 30000
                    $taxRate = 0;
                    $taxAddon = 0;
                    $range_from = 0;
                    $flag = 1;
                } else if ($value['annualincome_to'] == null && $annualIncome > $value['annualincome_from']) {    // High Level   1000000 To infinity 
                    $taxRate = $value['income_tax_rate'];
                    $taxAddon = $value['income_tax_value'];
                    $range_from = $value['annualincome_from'];
                    $flag = 2;
                } else if ($annualIncome > $value['annualincome_from'] && $annualIncome < $value['annualincome_to']) {
                    $taxRate = $value['income_tax_rate'];
                    $taxAddon = $value['income_tax_value'];
                    $range_from = $value['annualincome_from'];
                    $flag = 3;
                }
            }

            // $srtRates = TaxSettingsSrtModel::where('country_id', $employer->country_id)->get();
            // if ($srtRates->isEmpty()) {
            //     // $srtRates does not have any values
            //     $srtToWithhold = 0;
            // } else {
            //     // $srtRates has values
            //     foreach ($srtRates as $key => $value) {
            //         if ($value['annualincome_from'] == '0' && $annualIncome < $value['annualincome_to']) {
            //             $srtRate = $value['srt_tax'];
            //             $srtAddon = $value['srt_value'];
            //             $flag = 1;
            //         } else if ($value['annualincome_to'] == null && $annualIncome > $value['annualincome_from']) {
            //             $srtRate = $value['srt_tax'];
            //             $srtAddon = $value['srt_value'];
            //             $flag = 2;
            //         } else if ($annualIncome > $value['annualincome_from'] && $annualIncome < $value['annualincome_to']) {
            //             $srtRate = $value['srt_tax'];
            //             $srtAddon = $value['srt_value'];
            //             $flag = 3;
            //         }

            //         $srtAddon = $value['srt_value'];
            //         $A2 = $C2 * ($srtRate / 100) + $srtAddon;  // SRT On C2
            //         $G = 5;  //Number of completed pay periods including current period
            //         $B2 = 4;   //SRT 
            //         $B1 = 0;
            //     }

            //     // $A1 = $annualIncome * ($taxRate / 100);
            //     // $C2 = $annualIncome + $total_bonus;
            //     // $incomeTaxOnC2 = $C2 * ($taxRate / 100);
            //     // $incomeTaxOnC1 = $A1;
            //     // $G = 2;    //should be made dynamic - No of completed pay period including current
            //     // $B1 = 0;   //should be made dynamic - tax witheheld to date 
            //     // $incomeTaxToWithhold = (($A1 / $F * $G) - $B1 + ($incomeTaxOnC2 - $incomeTaxOnC1));
            //     // if ($incomeTaxToWithhold < 0) {
            //     //     $incomeTaxToWithhold = 0;
            //     // }

            //     $srtToWithhold = (($A2 / $F * $G) - $B2);
            //     if ($srtToWithhold < 0) {
            //         $srtToWithhold = 0;
            //     }
            // }

            $salary = $employee->rate;
            if (isset($taxRate)) {
                if ($flag == 1) {
                    $A1 = 0;
                } else {
                    $A1 = ($annualIncome - $range_from) * ($taxRate / 100) +  $taxAddon;
                }
                //  dd($total_bonus);
                $C2 = $annualIncome + $total_bonus;

                $incomeTaxOnC2 = ($C2 - $range_from) * ($taxRate / 100) +  $taxAddon;
                //   dd($incomeTaxOnC2);
                //  $incomeTaxOnC2 = 42200;
                $incomeTaxOnC1 = $A1;

                // dd($incomeTaxOnC1);
                // incomeTax withheld To date //B1= L5 + N5   - >based  on new Tax Formula

                // Find G Number of completed pay period including current
                $employee_id = $employee->id;
                //   $payroll_data=Payroll::where('user_id',$employee_id)->get();
                $payroll_data = Payroll::where('user_id', $employee_id)->latest()->first();
                if ($payroll_data) {
                    $no_pay_period = $payroll_data->payroll_data;
                    $income_tax_withheld_old = $payroll_data->income_tax_withheld;

                    $actual_icome_tax_withhold = $payroll_data->actual_icome_tax_withhold;
                    // incomtax_withheld=previous incomtax withheld + 
                    $B1 = $income_tax_withheld_old + $actual_icome_tax_withhold;

                    if ($no_pay_period == 0) {
                        $no_pay_period = 1;
                    } else {
                        if ($no_pay_period == $F) {
                            $no_pay_period = 1;
                        } else {
                            $no_pay_period = $no_pay_period + 1;
                        }
                    }
                } else {
                    $no_pay_period = 1;
                    $income_tax_withheld_old = 0;
                    $B1 = 0;
                }
                $G = $no_pay_period;
                //should be made dynamic - tax witheheld to date 
                $incomeTaxToWithhold = (($A1 / $F * $G) - $B1 + ($incomeTaxOnC2 - $incomeTaxOnC1));
                if ($incomeTaxToWithhold < 0) {
                    $incomeTaxToWithhold = 0;
                }
            }

            $total_tax = $incomeTaxToWithhold;
            //FNPF calculation
            $empTotalSalary = $employee->total_hours_per_week * $employee->rate;
            $fnpf_amount = 0;
            $country = Country::where('id', $employee->country_id)->first();
            $fnpf = ProvidentFund::where('user_id', $employee->id)->first();

            // if (!empty($country)) {     // 19-12-23 Based on the New Changes Country FNPF is Required. 
            //     if (!empty($country->fnpf)) {
            //         $country_fnpf = $country->fnpf;
            //         //$fnpf_amount += $employee->rate * (($country->fnpf) / 100);
            //     }
            // }


            // if (!empty($fnpf)) {
            //     if (!empty($fnpf->user_rate)) {
            //         $fnpf_amount += $empTotalSalary * (($fnpf->user_rate) / 100);
            //     }
            //     if (!empty($fnpf->employer_rate)) {
            //         $fnpf_amount += $empTotalSalary * (($fnpf->employer_rate) / 100);
            //     }
            // }
            $user_additional_contrubutions = 0;
            $user_additional_rate = 0;
            $employer_additional_contrubutions = 0;
            $employer_additional_rate = 0;

            if (!empty($country)) {     // 19-12-23 Based on the New Changes Country FNPF is Required. 
                if (!empty($country->fnpf)) {
                    $country_fnpf = $country->fnpf;
                    //$fnpf_amount += $employee->rate * (($country->fnpf) / 100);
                }
            }
            if (!empty($fnpf)) {
                if (!empty($fnpf->user_rate)) {
                    $user_additional_contrubutions =  $fnpf->user_rate - $country_fnpf;
                    $user_additional_rate = $employee->rate * (($user_additional_contrubutions) / 100);  // 
                    $fnpf_amount += $empTotalSalary * (($country->fnpf) / 100);
                }

                if (!empty($fnpf->employer_rate)) {
                    $employer_additional_contrubutions =  $fnpf->employer_rate -  $country_fnpf;
                    $employer_additional_rate = $employee->rate * (($employer_additional_contrubutions) / 100);
                    $fnpf_amount += $empTotalSalary * (($country->fnpf) / 100);
                }
            }

            // FNPF Deduction 
            $total_earn = $salary + $total_bonus;
            $fnpf_deduction = $total_earn * (($country->fnpf) / 100);


            //pending

            $base_pay = ($employee->rate * ($employee->total_hours_per_week));
            $totalEarnings = $base_pay + isset($total_pay) + isset($doubleTimeRate) ?? 0;
            $grossSalary = $totalEarnings + $commission_amount + $total_bonus;   //gross pay =  Base Pay + Overtime Pay + Double Pay + Bonus + Commission 
            $netSalary = $grossSalary - ($fnpf_amount + $total_tax); //net salary= Gross Pay – (Superannuation + All Taxes)
            $lwop = 0;
            $nonHolidayDates = $attendancesWithoutHoliday;
            $totalSalary = $netSalary + $totalAllowance - $totalDeduction; //Total Pay = Net pay + Allowances - Deductions
            $attendance_count = 0;
            //Payroll Entry
            $user = User::where('id', $employee->id)->first();
            $payDate = Carbon::now();
            $formattedDate = $payDate->format('Y-m-d');
            $user->pay_date = $formattedDate;
            $issave = $user->save();
            $payroll = new Payroll();
            $payroll->user_id = $employee->id;
            $payroll->employer_id = $employee->employer_id;
            $payroll->base_salary = $employee->rate;
            $payroll->paid_salary = $totalSalary;
            $payroll->net_salary = $netSalary;
            $payroll->total_tax = $total_tax;
            $payroll->gross_salary = $grossSalary;
            $payroll->total_deduction = $totalDeduction;
            $payroll->total_allowance = $totalAllowance;
            $payroll->total_commission = $commission_amount;
            $payroll->total_bonus = $total_bonus;
            $payroll->total_fnpf = $fnpf_amount;
            $payroll->start_date = $fromDate;
            $payroll->end_date = $payDate;
            $payroll->no_pay_period = $no_pay_period;
            $payroll->income_tax_withheld = $income_tax_withheld_old;
            $payroll->actual_icome_tax_withhold = $incomeTaxToWithhold;
            $payroll->fnpf_deduction = $fnpf_deduction;    // Monthly Contribution   18-12-23 
            $payroll->employee_additional_contributions = $user_additional_contrubutions;  // Monthly Contribution   18-12-23 
            $payroll->employee_additional_contributions_rate = $user_additional_rate;  // Monthly Contribution   18-12-23 
            $payroll->employer_additional_contributions = $employer_additional_contrubutions;  // Monthly Contribution   18-12-23 
            $payroll->employer_additional_contributions_rate = $employer_additional_rate;  // Monthly Contribution   18-12-23 


            $res = $payroll->save();
            $flag_payroll = 1;
            $srtToWithhold = 0;
            $paid_days = 4;  // Static Data
            $paid_hours = $totalHours;
            // Payslip Generation
            $this->slip_generation(
                $employee,
                $base_pay,
                $grossSalary,
                $netSalary,
                $totalSalary,
                $totalAllowance,
                $totalDeduction,
                $allowances,
                $deductions,
                $IncomeTaxToWithhold,
                $fnpf_amount,
                $srtToWithhold,
                $payroll,
                $fromDate,
                $endDate,
                $commission_amount,
                $total_bonus,
                $lwop,
                $nonHolidayDates,
                $doubleTimeRate,
                $paid_days,
                $paid_hours,
                $overtime_unit_rate,
                $doubletime_unit_rate
            );

            // PayslipGeneration::dispatch(
            //     $employee,
            //     $base_pay,
            //     $grossSalary,
            //     $netSalary,
            //     $totalSalary,
            //     $totalAllowance,
            //     $totalDeduction,
            //     $allowances,
            //     $deductions,
            //     $IncomeTaxToWithhold,
            //     $fnpf_amount,
            //     $srtToWithhold,
            //     $payroll,
            //     $fromDate,
            //     $endDate,
            //     $commission_amount,
            //     $total_bonus,
            //     $lwop,
            //     $nonHolidayDates,
            //     $doubleTimeRate
            // );
        }
    }

    public function generate_fixed_payroll($employee, $fromDate, $endDate)
    {

        $payPeriods[] = ['start_date' => $fromDate, 'end_date' => $endDate];
        $count_pay_period = count($payPeriods);

        $perDaySalary = ($employee->pay_period == '0') ? ($employee->rate / 7) : (($employee->pay_period == '1') ? ($employee->rate / 14) : ($employee->rate / ($fromDate->daysInMonth)));
        $attendances = Attendance::where('user_id', $employee->id)->whereBetween('date', [$fromDate, $endDate])->get();
        $attendance_count = $attendances->count();

        //Allowance Calculation
        $allowances = AssignAllowance::with('allowance')->where('user_id', $employee->id)->get();
        $totalAllowance = 0;
        if ($allowances) {
            $totalAllowance = $allowances->sum('rate');
        }
        //Deduction Calculation

        $deductions = AssignDeduction::with('deduction')->where('user_id', $employee->id)->get();
        $totalDeduction = 0;
        if ($deductions) {
            $totalDeduction = $deductions->sum(function ($deduction) use ($employee) {
                return $employee->rate * ($deduction->rate / 100);
            });
        }


        //Commissions Calculation
        $commission_amount = 0;
        $commission = Commission::where('user_id', $employee->id)->first();
        if (isset($commission)) {
            $commission_amount += $commission->rate;
        }

        //Bonus calculation
        $bonuses = Bonus::where('employer_id', $employee->employer_id)->get();
        $total_bonus = 0;
        if (isset($bonuses)) {

            foreach ($bonuses as $bonus) {
                if ($bonus->type == 0 && $employee->id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus += ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else if ($bonus->type == 1 && $employee->department_id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus += ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else if ($bonus->type == 2 && $employee->branch_id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus += ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else if ($bonus->type == 3 && $employee->business_id == $bonus->type_id) {
                    if ($bonus->rate_type == 0) {
                        $total_bonus += ($employee->rate * ($bonus->rate / 100));
                    } else {
                        $total_bonus += $bonus->rate;
                    }
                } else {
                    continue;
                }
            }
        }

        //Tax Calculation - Income tax   Fixed Basis
        //dd($employee->total_hours_per_week);
        $salary = $employee->rate;
        //  dd($salary);
        if ($employee->pay_period == "0") {
            $annualIncome = $salary * 52;
            $F = 52;
        } else if ($employee->pay_period == "1") {
            $annualIncome = $salary * 26;
            $F =  26;    //C1
        } else {
            $annualIncome = $salary * 12;
            $F =  12;    //C1
        }
        //dd($annualIncome);
        $employer = Employer::find($employee->employer_id)->first();
        $taxRates = TaxSettings::where('country_id', $employer->country_id)->get();
        $taxRate = 0;
        $taxAddon = 0;
        $srtRate = 0;
        $srtAddon = 0;
        $range_from= 0; 
        $flag = 0;


        foreach ($taxRates as $key => $value) {
            if ($value['annualincome_from'] == '0' && $annualIncome < $value['annualincome_to']) {  // Low Level   0 - 30000
                $taxRate = 0;
                $taxAddon = 0;
                $range_from = 0;
                $flag = 1;
            } else if ($value['annualincome_to'] == null && $annualIncome > $value['annualincome_from']) {    // High Level   1000000 To infinity 
                $taxRate = $value['income_tax_rate'];
                $taxAddon = $value['income_tax_value'];
                $range_from = $value['annualincome_from'];
                $flag = 2;
            } else if ($annualIncome > $value['annualincome_from'] && $annualIncome < $value['annualincome_to']) {
                $taxRate = $value['income_tax_rate'];
                $taxAddon = $value['income_tax_value'];
                $range_from = $value['annualincome_from'];
                $flag = 3;
            }
        }

        // $taxRate = $employee->country?->tax ?? 0;  // 08-12-23 Robin-  Now there is no tax in country Form
        $salary = $employee->rate;
        if (isset($taxRate)) {
            if ($flag == 1) {
                $A1 = 0;
            } else {
                $A1 = ($annualIncome - $range_from) * ($taxRate / 100) +  $taxAddon;
            }
            //  dd($total_bonus);
            $C2 = $annualIncome + $total_bonus;

            $incomeTaxOnC2 = ($C2 - $range_from) * ($taxRate / 100) +  $taxAddon;
            //   dd($incomeTaxOnC2);
            //  $incomeTaxOnC2 = 42200;
            $incomeTaxOnC1 = $A1;

            // dd($incomeTaxOnC1);
            // incomeTax withheld To date //B1= L5 + N5   - >based  on new Tax Formula

            // Find G Number of completed pay period including current
            $employee_id = $employee->id;
            //   $payroll_data=Payroll::where('user_id',$employee_id)->get();
            $payroll_data = Payroll::where('user_id', $employee_id)->latest()->first();
            if ($payroll_data) {
                $no_pay_period = $payroll_data->payroll_data;
                $income_tax_withheld_old = $payroll_data->income_tax_withheld;

                $actual_icome_tax_withhold = $payroll_data->actual_icome_tax_withhold;
                // incomtax_withheld=previous incomtax withheld + 
                $B1 = $income_tax_withheld_old + $actual_icome_tax_withhold;

                if ($no_pay_period == 0) {
                    $no_pay_period = 1;
                } else {
                    if ($no_pay_period == $F) {
                        $no_pay_period = 1;
                    } else {
                        $no_pay_period = $no_pay_period + 1;
                    }
                }
            } else {
                $no_pay_period = 1;
                $income_tax_withheld_old = 0;
                $B1 = 0;
            }
            $G = $no_pay_period;
            //should be made dynamic - tax witheheld to date 
            $incomeTaxToWithhold = (($A1 / $F * $G) - $B1 + ($incomeTaxOnC2 - $incomeTaxOnC1));
            if ($incomeTaxToWithhold < 0) {
                $incomeTaxToWithhold = 0;
            }
        }



        //Tax calculation - SRT
        $srtToWithhold = 0;
        // $salary = $employee->rate;
        // $srt_rate = $employee->country?->srt_tax ?? 0;
        // if ($employee->pay_period == "0") {
        //     $annualIncome = $salary * 52;
        //     $F = 52;
        // } else if ($employee->pay_period == "1") {
        //     $annualIncome = $salary * 26;
        //     $F =  26;    //C1
        // } else {
        //     $annualIncome = $salary * 12;
        //     $F =  12;    //C1
        // }
        // $A2 = $annualIncome * ($srt_rate / 100);
        // $G = 5; //should be made dynamic - No of completed pay period including current
        // $B2 = 4;  //should be made dynamic - tax witheheld to date 
        // $srtToWithhold = (($A2 / $F * $G) - $B2);
        // if ($srtToWithhold < 0) {
        //     $srtToWithhold = 0;
        // }

        $totalTaxAmount = $srtToWithhold + $incomeTaxToWithhold;

        //FNPF calculation
        $fnpf_amount = 0;
        $country = Country::where('id', $employee->country_id)->first();
        $fnpf = ProvidentFund::where('user_id', $employee->id)->first();

        if (!empty($country)) {     // 19-12-23 Based on the New Changes Country FNPF is Required. 
            if (!empty($country->fnpf)) {
                $country_fnpf = $country->fnpf;
                //$fnpf_amount += $employee->rate * (($country->fnpf) / 100);
            }
        }

        $user_additional_contrubutions = 0;
        $user_additional_rate = 0;
        $employer_additional_contrubutions = 0;
        $employer_additional_rate = 0;


        if (!empty($fnpf)) {
            if (!empty($fnpf->user_rate)) {
                $user_additional_contrubutions =  $fnpf->user_rate - $country_fnpf;
                $user_additional_rate = $employee->rate * (($user_additional_contrubutions) / 100);  // 
                $fnpf_amount += $employee->rate * (($country->fnpf) / 100);
            }

            if (!empty($fnpf->employer_rate)) {
                $employer_additional_contrubutions =  $fnpf->employer_rate -  $country_fnpf;
                $employer_additional_rate = $employee->rate * (($employer_additional_contrubutions) / 100);
                $fnpf_amount += $employee->rate * (($country->fnpf) / 100);
            }
        }

        // FNPF Deduction 
        $total_earn = $salary + $total_bonus;
        $fnpf_deduction = $total_earn * (($country->fnpf) / 100);

        //Absent calculation
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

        $paid_days = $count_pay_period - $lwop;
        $lwopAmount = $lwop * $perDaySalary;

        //Total salary calculation
        $base_pay = $employee->rate;
        $totalEarnings = $base_pay;
        $grossSalary = $totalEarnings + $commission_amount + $total_bonus;   //gross pay =  Base Pay + Overtime Pay + Double Pay + Bonus + Commission 
        $netSalary = $grossSalary - ($totalTaxAmount + $fnpf_deduction); //net salary= Gross Pay – (Superannuation + All Taxes)
        $totalSalary = $netSalary + $totalAllowance - $totalDeduction; //Total Pay (paid salary) = Net pay + Allowances - Deductions

        //Payroll Entry
        $user = User::where('id', $employee->id)->first();
        $payDate = Carbon::now();
        $formattedDate = $payDate->format('Y-m-d');
        $user->pay_date = $formattedDate;
        $issave = $user->save();
        $payroll = new Payroll();
        $payroll->user_id = $employee->id;
        $payroll->employer_id = $employee->employer_id;
        $payroll->base_salary = $employee->rate;
        $payroll->paid_salary = $totalSalary;
        $payroll->net_salary = $netSalary;
        $payroll->total_tax = $totalTaxAmount;
        $payroll->gross_salary = $grossSalary;
        $payroll->total_deduction = $totalDeduction;
        $payroll->total_allowance = $totalAllowance;
        $payroll->total_commission = $commission_amount;
        $payroll->total_bonus = $total_bonus;
        $payroll->total_fnpf = $fnpf_amount;
        $payroll->start_date = $fromDate;
        $payroll->end_date = $endDate;
        $payroll->paid_status = '0';
        $payroll->pay_date = $formattedDate;
        $payroll->no_pay_period = $no_pay_period;
        $payroll->income_tax_withheld = $income_tax_withheld_old;
        $payroll->actual_icome_tax_withhold = $incomeTaxToWithhold;
        $payroll->fnpf_deduction = $fnpf_deduction;    // Monthly Contribution   18-12-23 
        $payroll->employee_additional_contributions = $user_additional_contrubutions;  // Monthly Contribution   18-12-23 
        $payroll->employee_additional_contributions_rate = $user_additional_rate;  // Monthly Contribution   18-12-23 
        $payroll->employer_additional_contributions = $employer_additional_contrubutions;  // Monthly Contribution   18-12-23 
        $payroll->employer_additional_contributions_rate = $employer_additional_rate;  // Monthly Contribution   18-12-23 

        $res = $payroll->save();
        $flag_payroll = 1;
        //Payslip generation
        // Paid Days, Paid Hours, Base Rate, Double Time, Allowance Rate,Bonus Rate, Commission Rate,
        // Gross Earnings, Loan , Union, Surcharge, Total Deductions 
        // $paid_days = $attendance_count;
        $paid_hours = 0;
        $base_rate = 0;
        //   $doubleTimeRate;
        $allowance_rate = 0;
        $bonus_rate = 0;
        $commission_rate = 0;
        $gross_earnings = 0;
        $loan = 0;
        $union = 0;
        $surcharge = 0;
        $total_deduction = 0;
        $doubleTimeRate = "-";
        $overtime_unit_rate = "-";
        $doubletime_unit_rate = "-";

        $this->slip_generation(
            $employee,
            $base_pay,
            $grossSalary,
            $netSalary,
            $totalSalary,
            $totalAllowance,
            $totalDeduction,
            $allowances,
            $deductions,
            $incomeTaxToWithhold,
            $fnpf_amount,
            $srtToWithhold,
            $payroll,
            $fromDate,
            $endDate,
            $commission_amount,
            $total_bonus,
            $lwop,
            $nonHolidayDates,
            $doubleTimeRate,
            $attendance_count,
            $paid_days,
            $paid_hours,
            $overtime_unit_rate,
            $doubletime_unit_rate
        );
    }

    public function slip_generation(
        $employee,
        $base_pay,
        $grossSalary,
        $netSalary,
        $totalSalary,
        $totalAllowance,
        $totalDeduction,
        $allowances,
        $deductions,
        $incomeTaxToWithhold,
        $fnpf_amount,
        $srtToWithhold,
        $payroll,
        $fromDate,
        $endDate,
        $commission_amount,
        $total_bonus,
        $lwop,
        $nonHolidayDates,
        $doubleTimeRate,
        $paid_days,
        $paid_hours,
        $overtime_unit_rate,
        $doubletime_unit_rate
    ) {
        PayslipGeneration::dispatch(
            $employee,
            $base_pay,
            $grossSalary,
            $netSalary,
            $totalSalary,
            $totalAllowance,
            $totalDeduction,
            $allowances,
            $deductions,
            $incomeTaxToWithhold,
            $fnpf_amount,
            $srtToWithhold,
            $payroll,
            $fromDate,
            $endDate,
            $commission_amount,
            $total_bonus,
            $lwop,
            $nonHolidayDates,
            $doubleTimeRate,
            $paid_days,
            $paid_hours,
            $overtime_unit_rate,
            $doubletime_unit_rate
        );
    }

    public function revert_payroll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 400);
        }
        // Step 1: Retrieve the last date
        $lastRecord = Payroll::where('employer_id', $request->employer_id)->where('paid_status', '0')->latest()->first();
        if ($lastRecord) {


            $lastDate = $lastRecord->pay_date;

            // Step 2: Delete rows with the last date
            $result = Payroll::with('user')->where('employer_id', $request->employer_id)->where('pay_date', $lastDate)->where('paid_status', '0')->delete();
            if ($result) {
                $payrolls = Payroll::where('employer_id', $request->employer_id)->latest()->get();
                return response()->json([
                    'message' => 'Payroll Revert successfully.',
                    'data' => $payrolls
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Something went wrong',
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'No record Found',
                'data' => 0
            ], 200);
        }
    }

    public function revert_web()
    {
        $requestData = [
            'employer_id' => Auth::guard('employer')->user()->id,
        ];

        $request = new Request($requestData);
        $result = $this->revert_payroll($request);
        return redirect()->back()->with('message', $result);
    }



    public function generate_web(Request $request)
    {
        // dd($request->all());
        $payroll_type = $request->payroll_type;
        $payrollcontroller = new PayrollCalculationController;
        if ($payroll_type == '1') {
            // All Employees Payroll Section
            $flag = 'all';
            $id[] = $request->users;
        } else {
            // Choose Employee Payroll Section
            if ($request->users != null) {
                $flag = 'others';
                $id = $request->users;
            } else if ($request->department != null) {
                $flag = "department";
                $id[] = $request->department;
            } else if ($request->branch != null) {
                $flag = "branch";
                $id[] = $request->branch;
            } else if ($request->business != null) {
                $flag = "business";
                $id[] = $request->business;
            }
        }
        $requestData = [
            'employer_id' => Auth::guard('employer')->user()->id,
            'flag' => $flag,
            'id' => $id
            // Add more field-value pairs as needed
        ];

        $request = new Request($requestData);
        $result = $payrollcontroller->payroll($request);
        return redirect()->back()->with('message', $result);
        //        return $result;
    }
}
