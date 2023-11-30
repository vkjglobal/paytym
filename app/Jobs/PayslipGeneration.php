<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Payroll;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PayslipGeneration implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $employee;
    protected $base_pay;
    protected $grossSalary;
    protected $netSalary;
    protected $totalSalary;
    protected $totalAllowance;
    protected $totalDeduction;
    protected $allowances;
    protected $deductions;
    protected $incomeTax;
    protected $fnpf;
    protected $srt;
    protected $payroll;
    protected $fromDate;
    protected $endDate;
    protected $commission_amount;
    protected $total_bonus;
    protected $lwop;
    protected $nonHolidayDates;
    protected $doubleTimeRate;



    public function __construct(
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
        $doubleTimeRate
    ) {

        $this->employee = $employee;
        $this->base_pay = $base_pay;
        $this->grossSalary = $grossSalary;
        $this->netSalary = $netSalary;
        $this->totalSalary = $totalSalary;
        $this->totalAllowance = $totalAllowance;
        $this->totalDeduction = $totalDeduction;
        $this->allowances = $allowances;
        $this->deductions = $deductions;
        $this->incomeTax = $incomeTaxToWithhold;
        $this->fnpf = $fnpf_amount;
        $this->srt = $srtToWithhold;
        $this->payroll = $payroll;
        $this->fromDate = $fromDate;
        $this->endDate = $endDate;
        $this->commission_amount = $commission_amount;
        $this->total_bonus = $total_bonus;
        $this->lwop = $lwop;
        $this->nonHolidayDates = $nonHolidayDates;
        $this->doubleTimeRate = $doubleTimeRate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $employer_id=Auth::guard('employer')->user()->id;
            $business_name=Auth::guard('employer')->user()->company;
            $street= Auth::guard('employer')->user()->street;
            $city= Auth::guard('employer')->user()->city;
            $employee = $this->employee;
            $base_pay =  $this->base_pay;
            $grossSalary = $this->grossSalary;
            $netSalary = $this->netSalary;
            $totalSalary = $this->totalSalary;
            $totalAllowance =  $this->totalAllowance;
            $totalDeduction = $this->totalDeduction;
            $allowances = $this->allowances;
            $deductions = $this->deductions;
            $income_tax = $this->incomeTax;
            $fnpf = $this->fnpf;
            $srt = $this->srt;
            $payroll = $this->payroll;
            $fromDate = $this->fromDate;
            $endDate = $this->endDate;
            $commission_amount = $this->commission_amount;
            $total_bonus = $this->total_bonus;
            $lwop = $this->lwop;
            $nonHolidayDates = count($this->nonHolidayDates);
            $doubleTimeRate=$this->doubleTimeRate;
            $now = Carbon::now();
            $dateString = $now->format('ymd');
            $count = Payroll::where('employer_id', $employee->employer->id)->where('created_at', $now)->count();
            $count_no = ($count + 1);
            $sequenceString = str_pad($count_no, 3, '0', STR_PAD_LEFT);
            $paySlipNumber = 'PS' . $dateString . '-' . $sequenceString;
            $pdf = PDF::loadView('employer.payslip.templates.default', compact(
                'employee',
                'base_pay',
                'grossSalary',
                'netSalary',
                'totalSalary',
                'totalAllowance',
                'totalDeduction',
                'allowances',
                'deductions',
                'income_tax',
                'fnpf',
                'srt',
                'fromDate',
                'endDate',
                'paySlipNumber',
                'commission_amount',
                'total_bonus',
                'lwop',
                'nonHolidayDates',
                'doubleTimeRate',
                'payroll',
                'business_name',
                'street',
                'city'
            ));

            $carbonDate = Carbon::parse($endDate);
            // Format the date
            $formattedDate = $carbonDate->format('d-m-Y');

            $filename = 'EMP' . $employee->employer->id . '_PS_' . $formattedDate . '.pdf';
            $path = 'pdfs/' . $filename;
            $issave = $pdf->save(storage_path('app/public/' . $path));
            if ($issave) {
                $payroll->pay_slip = $filename;
                $payroll->payslip_number = $paySlipNumber;
                $payroll->save();
            } 
        } catch (\Exception $e) {
            // Log or report the error
            \Log::error($e);
        }
    }
}
