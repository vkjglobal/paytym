<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function __construct($employee,$base_pay,$grossSalary,$netSalary,$totalSalary,$totalAllowance,$totalDeduction)
    {
        $this->employee = $employee;
        $this->base_pay = $base_pay;
        $this->grossSalary = $grossSalary;
        $this->netSalary = $netSalary;
        $this->totalSalary = $totalSalary;
        $this->totalAllowance = $totalAllowance;
        $this->totalDeduction = $totalDeduction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $employee = $this->employee;
        $base_pay =  $this->base_pay;
        $grossSalary = $this->grossSalary;
        $netSalary = $this->netSalary;
        $totalSalary = $this->totalSalary;
        $totalAllowance =  $this->totalAllowance;
        $totalDeduction = $this->totalDeduction;
        $pdf = PDF::LoadView('employer.payslip.templates.default',compact('employee',
                                                                'base_pay',
                                                                'grossSalary',
                                                                'netSalary',
                                                                'totalSalary',
                                                                'totalAllowance',
                                                                'totalDeduction',
                                                                ))->setPaper('legal', 'landscape');

        $pdf->save(storage_path('app/public/pdfs/myfile.pdf'));

    }
}
