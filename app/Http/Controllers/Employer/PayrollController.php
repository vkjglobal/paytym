<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Attendance;
use App\Models\AssignAllowance;
use App\Models\Leaves;
use App\Models\AssignDeduction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrolls = Payroll::all();

        return view('employer.Payroll.index', compact('payrolls'));
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

        if($res){
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

    public function generate_form(){
        return view('employer.payroll.generate');
    }

    public function generate_hourly_payroll($employee,$fromDate,$payDate){
            
            $attendances = Attendance::where('user_id' ,$employee->id )->whereBetween('date',[$fromDate,$payDate])->get();
            $attendance_dup = $attendances; 
            $holidays = Leaves::whereBetween('date',[$fromDate ,$payDate])->get();
            
            $holidayArray = $holidays->pluck('date')->toArray();
            $totalHours = 0;
            $attendancesWithoutHoliday = $attendances->reject(function ($attendance) use ($holidayArray) {
                return in_array($attendance->date, $holidayArray);
            });

            foreach($attendances as $attendance){
                $checkIn = Carbon::parse($attendance->check_in);
                $checkOut = Carbon::parse($attendance->check_out);
                // calculate the number of hours worked for this day
                $hoursWorked = $checkIn->diffInHours($checkOut);
                $totalHours += $hoursWorked;
            } 
           

            //Extra hours at base rate and over time rate calculation
            $overtimerate = $employee->business->payrollsetting->over_time_rate;
            if($totalHours > $employee->total_hours_per_week){
                $extraHours = $totalHours - ($employee->total_hours_per_week);

                if($extraHours > $employee->extra_hours_at_base_rate){
                    $overTimeHours = $extraHours - $employee->extra_hours_at_base_rate;
                    $extraOverTimeSalary = ($overTimeHours * ($employee->rate * $overtimerate));
                    $extraBaseTimeSalary = ($employee->rate * ($employee->extra_hours_at_base_rate));
                    $total_pay = $extraOverTimeSalary + $extraBaseTimeSalary;  //overtime salary + over time base
                }else{
                    $total_pay = ($extraHours * $employee->rate); //over time base salary
            }

            //Double time calculation
            $doubletimerate = $employee->business->payrollsetting->double_time_rate;
            foreach($holidays as $holiday){
                foreach($attendance_dup as $attendance){
                    if($attendance->date == $holiday->date){
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

            $allowances = AssignAllowance::where('user_id',$employee->id)->get();
            $totalAllowance = 0;
            foreach($allowances as $allowance){
                $totalAllowance += $allowance->rate;
            }
            

            //Deduction Calculation

            $deductions = AssignDeduction::where('user_id',$employee->id)->get();
            $totalDeduction = 0;
            foreach($deductions as $deduction){
                $totalDeduction += ($employee->rate * ($deduction->rate/100));
            }
            
            $base_pay = ($employee->rate * ($totalHours - $extraHours)); 
            $totalEarnings = $base_pay + $total_pay + $doubleTimeRate ;
           
            $totalEarnings += $totalAllowance - $totalDeduction;
            
            //Payroll Entry
            $user = User::where('id',$employee->id)->first();
            $date = Carbon::parse($payDate);
            $formattedDate = $date->format('Y-m-d');
            $user->pay_date = $formattedDate;
            $user->save();
            $payroll = new Payroll();
            $payroll->paid_salary = $totalEarnings;
            $payroll->fund_deduction = $totalDeduction;
            $payroll->total_deduction = $totalDeduction;
            $payroll->fund_deduction = "50";
            $payroll->user_id = $employee->id;
            $payroll->salary = $totalEarnings;
            
            $res=$payroll->save();

            if($res){
                return "success";
            }
        
        }
        

    
    }

    public function generate_fixed_payroll($employee,$payDate,$fromDate){
        $attendances = Attendance::where('user_id' ,$employee->id )->whereBetween('date',[$fromDate,$payDate])->get();
        
         //Allowance Calculation

         $allowances = AssignAllowance::where('user_id',$employee->id)->get();
         $totalAllowance = 0;
         foreach($allowances as $allowance){
             $totalAllowance += $allowance->rate;
         }

         //Deduction Calculation

         $deductions = AssignDeduction::where('user_id',$employee->id)->get();
         $totalDeduction = 0;
         foreach($deductions as $deduction){
             $totalDeduction += ($employee->rate * ($deduction->rate/100));
         }
         

         //Total salary calculation
         $baseSalary = $employee->rate;
         $totalEarnings = ($baseSalary + $totalAllowance) - $totalDeduction;
         

           //Payroll Entry
           $payroll = new Payroll();
           $payroll->paid_salary = $totalEarnings;
           $payroll->fund_deduction = $totalDeduction;
           $payroll->total_deduction = $totalDeduction;
           $payroll->fund_deduction = "50";
           $payroll->user_id = $employee->id;
           $payroll->salary = $totalEarnings;
           $res=$payroll->save();
           
        

     }
}

