<?php

namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Attendance;
use App\Models\AssignAllowance;
use App\Models\Leaves;
use App\Models\Commission;
use App\Models\AssignDeduction;
use App\Models\Bonus;
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
            if(isset($allowances)){
                foreach($allowances as $allowance){
                    $totalAllowance += $allowance->rate;
                }
            }
            
            

            //Deduction Calculation
            $totalDeduction = 0;
            $deductions = AssignDeduction::where('user_id',$employee->id)->get();
            if(isset($deductions)){
                foreach($deductions as $deduction){
                    $totalDeduction += ($employee->rate * ($deduction->rate/100));
            }    
            }

            
            //Commissions Calculation
            $commission_amount = 0 ;
            $commission = Commission::where('user_id',$employee->id)->first();
           if(isset($commission)){
            $commission_amount += $commission->rate;
           } 


            //Bonus calculation
            $bonuses = Bonus::where('employer_id',$employee->employer_id)->get();
            $total_bonus = 0;
            foreach($bonuses as $bonus){
                if($bonus->type == 0 && $employee->id == $bonus->type_id){
                    if($bonus->rate_type == 0){
                        $total_bonus =( $employee->rate * ($bonus->rate / 100 ));
                    }else{
                        $total_bonus += $bonus->rate;
                    }
                }else if($bonus->type == 1 && $employee->department_id == $bonus->type_id){
                    if($bonus->rate_type == 0){
                        $total_bonus =( $employee->rate * ($bonus->rate / 100 ));
                    }else{
                        $total_bonus += $bonus->rate;
                    }
                }else if($bonus->type == 2 && $employee->branch_id == $bonus->type_id){
                    if($bonus->rate_type == 0){
                        $total_bonus =( $employee->rate * ($bonus->rate / 100 ));
                    }else{
                        $total_bonus += $bonus->rate;
                    }
                }else if($bonus->type == 3 && $employee->business_id == $bonus->type_id){
                    if($bonus->rate_type == 0){
                        $total_bonus =( $employee->rate * ($bonus->rate / 100 ));
                    }else{
                        $total_bonus += $bonus->rate;
                    }
                }else{
                    continue;
                }
            }

            //Tax Calculation - Income tax , SRT , Ecal
            // $tax_amount = 0;
            // $weeklySalary = $employee->rate * $employee->total_hours_per_week;
            // if($employee->pay_period == "0"){
            //       $annualIncome = $weeklySalary * 52; 
            //       $F = 52;      
            // }else{
            //     $annualIncome = $weeklySalary * 26 ;  
            //     $F =  26;    //C1
            // }

            // $A1 = $annualIncome * ($employee->country->tax / 100);
            // $C2 = $annualIncome + $total_bonus;
            // $incomeTaxOnC2 = $C2 * ($employee->country->tax / 100);
            // $incomeTaxOnC1 = $A1;
            // $G = 2;    //should be made dynamic - No of completed pay period including current
            // $B1 = 0;   //should be made dynamic - tax witheheld to date 
            // $IncomeTaxToWithhold = (($A1/$F * $G) - $B1 + ($incomeTaxOnC2 -$incomeTaxOnC1));

            
            




            //pending
            
            $base_pay = ($employee->rate * ($employee->total_hours_per_week)); 
            $totalEarnings = $base_pay + isset($total_pay) + isset($doubleTimeRate) ;
            $grossSalary = $totalEarnings + $commission_amount + $total_bonus;   //gross pay =  Base Pay + Overtime Pay + Double Pay + Bonus + Commission 
            $netSalary = $grossSalary - 60; //net salary= Gross Pay – (Superannuation + All Taxes)
           
            $totalSalary = $netSalary + $totalAllowance - $totalDeduction; //Total Pay = Net pay + Allowances - Deductions
            
            //Payroll Entry
            $user = User::where('id',$employee->id)->first();
            $date = Carbon::parse($payDate);
            $formattedDate = $date->format('Y-m-d');
            $user->pay_date = $formattedDate;
            $user->save();
            $payroll = new Payroll();
            $payroll -> user_id = $employee->id;
            $payroll -> employer_id = $employee->employer_id;
            $payroll -> base_salary = $employee->rate;
            $payroll -> paid_salary = $totalSalary;
            $payroll -> net_salary = $netSalary;
            $payroll -> gross_salary = $grossSalary;
            $payroll -> total_deduction = $totalDeduction;
            $payroll -> total_allowance = $totalAllowance;
            $payroll -> total_commission = $commission_amount;
            $payroll -> total_bonus = $total_bonus;
            
            $res = $payroll->save();
    
    }

    public function generate_fixed_payroll($employee,$fromDate,$endDate){
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

