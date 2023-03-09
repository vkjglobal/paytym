<?php

namespace App\Http\Controllers\Employer;

use App\Exports\Employer\AllowanceExport;
use App\Exports\Employer\AttendanceReportExport;
use App\Exports\Employer\DeductionExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Exports\Employer\EmployeePeriodExport;
use App\Exports\Employer\EmployeeReportExport;
use App\Exports\Employer\PayrollExport;
use App\Exports\Employer\StatusBranchExport;
use App\Exports\Employer\StatusBusinessExport;
use App\Exports\Employer\StatusDepartmentExport;
use App\Exports\Employer\StatusProjectExport;
use App\Models\Allowance;
use App\Models\AssignAllowance;
use App\Models\AssignDeduction;
use App\Models\Branch;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\Payroll;
use App\Models\Project;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\EmployeeFilter;

class ReportController extends Controller
{
    use EmployeeFilter;
    public $successStatus = 200;
    public function employer_id()
    {
        return Auth::guard('employer')->id();
    }

    public function attendance_index(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Report')), null]
        ];

        $attendances = Attendance::where('employer_id', $this->employer_id())->get();
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get(); 
        $users = User::where('employer_id', $this->employer_id())->get();
        $businesses = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        $branches = Branch::where('employer_id', $this->employer_id())->get();
        $departments = Department::where('employer_id', $this->employer_id())->get();
        return view('employer.report.attendace_list',compact('breadcrumbs', 'attendances', 'employees', 'branches','users', 'departments', 'businesses'));
    }

    public function attendance_filter(Request $request){
        $users = User::where('employer_id', Auth::guard('employer')->id())->get(); 
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $employer_id = $this->employer_id();
        $employees = $this->report_filter($request); 
        $employeesId = $employees->pluck('id');
        $attendances = Attendance::whereIn('user_id', $employeesId)->whereBetween('date',[$date_from, $date_to])->get();
        return view('employer.report.attendance_list_filter',compact( 'employees', 'users', 'date_from', 'date_to', 'request','employer_id'));
    }
    public function attendance_filter_export(Request $request) 
    {
        // (object)$employees;
        // return(gettype((object)$employees));
        // return($request);
        return Excel::download(new AttendanceReportExport($request), 'attendance_filter_export-'.Carbon::now().'.xlsx');
    }
//////////////////employment_period
    public function employment_period_index()
    {
        $employees = User::where('employer_id', $this->employer_id())->get()->sortBy('employment_end_date');
        $users = User::where('employer_id', $this->employer_id())->get();
        $businesses = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        $branches = Branch::where('employer_id', $this->employer_id())->get();
        $departments = Department::where('employer_id', $this->employer_id())->get();
        return view('employer.report.employee_period_list',compact('employees','branches','users', 'departments', 'businesses'));
    }
    //////ajax get branch department business user//////
    public function employee_period_get_branch($business_id=0)
    {
        $branchData['data'] = Branch::orderby("name","asc")->select('id','name')
        ->where('employer_id', $this->employer_id())->where('employer_business_id', $business_id)->get();
        return response()->json($branchData);
    }
    public function employee_period_get_department($branch_id=0)
    {
        $departmentData['data'] = Department::orderby("dep_name","asc")->select('id','dep_name')
        ->where('employer_id', $this->employer_id())->where('branch_id', $branch_id)->get();
        return response()->json($departmentData);
    }
    public function employee_period_get_user($department_id=0)
    {
        $userData['data'] = User::orderby("first_name","asc")->select('id','first_name')
        ->where('employer_id', $this->employer_id())->where('department_id', $department_id)->get();
        return response()->json($userData);
    }
    /////////////////////////////////////////////////////
    public function employee_period_filter(Request $request)
    {
        // dd($request);
    if ($request->ajax()){
        $employees = $this->report_filter($request); 
        $users = User::where('employer_id', $this->employer_id())->get();
        $businesses = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        $branches = Branch::where('employer_id', $this->employer_id())->get();
        $departments = Department::where('employer_id', $this->employer_id())->get();
        $emp = User::find($request->employee);
        return view('employer.report.table.employee_period_table',compact('employees', 'businesses', 'users', 'branches', 'departments', 'emp'));
    }else {
        return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
    } 
    }
    public function employment_period_export() 
    {
        return Excel::download(new EmployeePeriodExport, 'employment_period_export-'.Carbon::now().'.xlsx');
    }

//////////////employee_list
    public function employee_list_index()
    {
        $employees = User::where('employer_id', $this->employer_id())->get();
        $users = User::where('employer_id', $this->employer_id())->get();
        $businesses = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        $branches = Branch::where('employer_id', $this->employer_id())->get();
        $departments = Department::where('employer_id', $this->employer_id())->get();
        return view('employer.report.employee_list',compact('employees','branches','users', 'departments', 'businesses'));
    }
    public function employee_list_filter(Request $request)
    {
        // dd($request);
    if ($request->ajax()){
        $employees = $this->report_filter($request);
        $users = User::where('employer_id', $this->employer_id())->get();
        $businesses = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        $branches = Branch::where('employer_id', $this->employer_id())->get();
        $departments = Department::where('employer_id', $this->employer_id())->get();
        $emp = User::find($request->employee);
        return view('employer.report.table.employee_list_table',compact('employees', 'businesses', 'users', 'branches', 'departments', 'emp'));
    }else {
        return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
    } 
    }
    public function employee_list_export() 
    {
        return Excel::download(new EmployeeReportExport, 'employee_report_export-'.Carbon::now().'.xlsx');
    }

/////status_list
    public function status_list_index()
    {
        $employees = User::where('employer_id', $this->employer_id())->get();
        return view('employer.report.status_index',compact('employees'));
    }
    
    
    public function status_business()
    {
        $business = EmployerBusiness::where('employer_id', $this->employer_id())->get();
        return view('employer.report.status_business',compact('business'));
    }
    public function status_business_export() 
    {
        return Excel::download(new StatusBusinessExport, 'status_business_export-'.Carbon::now().'.xlsx');
    }
    public function status_business_export_print() 
    {
        return Excel::download(new StatusBusinessExport, 'status_business_export-'.Carbon::now().'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }


    public function status_branch()
    {
        $branches = Branch::where('employer_id', $this->employer_id())->get();
        return view('employer.report.status_branch',compact('branches'));
    }
    public function status_branch_export() 
    {
        return Excel::download(new StatusBranchExport, 'status_branch_export-'.Carbon::now().'.xlsx');
    }

    public function status_department()
    {
        $departments = Department::where('employer_id', $this->employer_id())->get();
        return view('employer.report.status_department',compact('departments'));
    }
    public function status_department_export() 
    {
        return Excel::download(new StatusDepartmentExport, 'status_department_export-'.Carbon::now().'.xlsx');
    }

    public function status_project()
    {
        $projects = Project::where('employer_id', $this->employer_id())->get();
        return view('employer.report.status_project',compact('projects'));
    }
    public function status_project_export() 
    {
        return Excel::download(new StatusProjectExport, 'status_project_export-'.Carbon::now().'.xlsx');
    }
///////allowance
    public function allowane_index() 
    {
        $employees = User::where('employer_id', $this->employer_id())->get();
        $allowances = Allowance::where('employer_id', $this->employer_id())->get();
        return view('employer.report.allowance_list',compact('employees', 'allowances'));
    }
    public function allowance_view($id) 
    {
        $employees = User::where('employer_id', $this->employer_id())->where('id', $id)->first();
        $allowances = Allowance::where('employer_id', $this->employer_id())->get();
        $assign_allowances = AssignAllowance::where('employer_id', $this->employer_id())->where('user_id', $id)->get();
        return view('employer.report.allowance_view',compact('employees', 'allowances','assign_allowances'));
    }
    public function allowance_export() 
    {
        return Excel::download(new AllowanceExport, 'allowance_export-'.Carbon::now().'.xlsx');
    }
////////deduction
public function deduction_index() 
    {
        $employees = User::where('employer_id', $this->employer_id())->get();
        $deductions = Deduction::where('employer_id', $this->employer_id())->get();
        return view('employer.report.deduction_list',compact('employees', 'deductions'));
    }
    public function deduction_view($id) 
    {
        $employees = User::where('employer_id', $this->employer_id())->where('id', $id)->first();
        $deductions = Deduction::where('employer_id', $this->employer_id())->get();
        $assign_deductions = AssignDeduction::where('employer_id', $this->employer_id())->where('user_id', $id)->get();
        return view('employer.report.deduction_view',compact('employees', 'deductions','assign_deductions'));
    }
    public function deduction_export() 
    {
        return Excel::download(new DeductionExport, 'deduction_export-'.Carbon::now().'.xlsx');
    }
    /////payroll
    public function payroll_index()
    {
        $payrolls = Payroll::where('employer_id', $this->employer_id())->get();
        return view('employer.report.payroll_list',compact('payrolls'));
    }
    public function payroll_export() 
    {
        return Excel::download(new PayrollExport, 'payroll_report_export-'.Carbon::now().'.xlsx');
    }

}