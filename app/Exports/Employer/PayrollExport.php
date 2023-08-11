<?php

namespace App\Exports\Employer;

use App\Http\Controllers\Employer\ReportController;
use App\Models\Payroll;
use App\Models\User;
use Countable;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Traits\EmployeeFilter;

class PayrollExport implements FromView
{
    use EmployeeFilter;
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function employer_id()
    {
        return $this->request->employer_id;
    }

    public function view(): View
    {
       // $today = Carbon::now()->format('Y-m-d');
        $start_date = $this->request->start_date;
        $end_date = $this->request->end_date;
        $employer_id = $this->employer_id();
        $employees = $this->report_filter($this->request); 
        $employeesId = $employees->pluck('id');
        //return $employeesId;
        if ($employeesId && !$start_date && !$end_date) {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->whereIn('user_id', $employeesId)->get();
        }
       
        if($employeesId && $start_date && $end_date)
        {
            //$payrolls = Payroll::whereIn('user_id', $employeesId)->whereBetween('start_date',[$date_from, $date_to])->get();
            $payrolls = Payroll::where('employer_id', $this->employer_id())->whereIn('user_id', $employeesId)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date]);
            })
            ->get();
            
        }
        if($start_date && $end_date && !$employeesId)
        {
            //$payrolls = Payroll::whereBetween('start_date',[$date_from, $date_to])->get();
            $payrolls = Payroll::where('employer_id', $this->employer_id())->where(function ($query) use ($start_date, $end_date) {
            $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date]);
            })
            ->get();
        }
        if ($start_date && !$employeesId) {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->where('start_date','>=', $start_date)->get();
        } if ($end_date && !$employeesId) {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->where('end_date','<=', $end_date)->get();
        }
        if ($start_date && !$end_date) {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->where('start_date','>=', $start_date)->get();
        } 
        if ($end_date && !$start_date) {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->where('end_date','<=', $end_date)->get();
        }
        if(!$this->request->business && !$this->request->user && !$start_date && !$end_date)
        {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->get();
        }
        if ($start_date && $employeesId && !$end_date) {
            $payrolls = Payroll::where('employer_id', $this->employer_id())->whereIn('user_id', $employeesId)
            ->where('start_date','>=', $start_date)->get();
        }
        return view('employer.report.export.payroll_list', compact('employees','start_date', 'end_date', 'payrolls','employer_id'));

        /* $payrolls = Payroll::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.report.export.payroll_list', [
            'payrolls' => $payrolls
        ]); */
    }
}
