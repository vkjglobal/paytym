<?php

namespace App\Exports\Employer;

use App\Http\Controllers\Employer\ReportController;
use App\Models\User;
use Countable;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use App\Traits\EmployeeFilter;

use App\Models\FrcsEmployeeData;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use App\Models\EmployerBusiness;

use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeFRCSExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Report')), null]
        ];
        $start_date = $this->request->start_date;
        $end_date = $this->request->end_date;
        $employer_id = $this->employer_id();
        //dd($this->request->business);
        //
        //$frcs = FrcsEmployeeData::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $businesses = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        $frcs = User::query()
        ->where('employer_id', $this->employer_id());

    if ($this->request->filled('business')) {
        $frcs->where('business_id', $this->request->input('business'));
    }

    if ($this->request->filled('pay_period')) {
        $frcs->where('pay_period', $this->request->input('pay_period'));


    }

    if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
        $start_date = $this->request->input('start_date');
        $end_date = $this->request->input('end_date');

        $frcs->whereHas('frcs', function ($query) use ($start_date, $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        });
    }

    $frcs = $frcs->orderBy('created_at', 'desc')->get();
    //return view('employer.report.employee_frcs_list', compact('breadcrumbs','frcs','employer_id','businesses'));
        
        
        //$frcs = User::with('frcs')->where('employer_id', Auth::guard('employer')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('employer.report.table.employeefrcs_list_table',compact('frcs'));
    }
}
