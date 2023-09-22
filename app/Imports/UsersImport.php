<?php

namespace App\Imports;

use App\Models\User;
use App\Models\EmployerBusiness;
use App\Models\Department;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Role;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employer = Auth::guard('employer')->user();
       //dd($row['date_of_birth']);
        $businessName = $row['business_name'];
        $business = EmployerBusiness::where('name', $businessName)->where('employer_id',$employer->id)->first();
        $branch = Branch::where('name', $row['branch_name'])->where('employer_id',$employer->id)->where('employer_business_id',$business->id)->first();
        $country = Country::where('name', $row['country_name'])->first();
        $departmentName = $row['department_name'];
        $department = Department::where('dep_name', $departmentName)->where('employer_id',$employer->id)->where('branch_id',$branch->id)->first();
        $position= Role::where('role_name', $row['position'])->where('employer_id',$employer->id)->first();
        $password =  Str::random(8);
        
        if(!$employer)
        {
            return null;
        }
        else
        {
        return new User([
            'employer_id' => $employer->id, //$employer ? $employer->id : null,
            'job_title'    => $row['job_title'], 
            'employment_start_date' => $row['employment_start_date'],
            'employment_end_date' => $row['employment_end_date'],
            'check_in_default' => $row['check_in_default'],
            'check_out_default' => $row['check_out_default'],
            'check_out_requred' => $row['check_out_requred'],
            //'payed_date' => $row['payed_date'],
            //'pay_date'=> $row['pay_date'],
            'bank_branch_name' => $row['bank_branch_name'],
            //'business_id'=> $row['business_id'],
            'business_id' => $business ? $business->id : null,
            

            //'department_id'=> $row['department_id'],
            'department_id' => $department ? $department->id : null,
            'salary_type'=> $row['salary_type'],
            'rate'=> $row['rate'],
            'workdays_per_week'=> $row['workdays_per_week'],
            'total_hours_per_week'=> $row['total_hours_per_week'],
            'extra_hours_at_base_rate'=> $row['extra_hours_at_base_rate'],
            'employee_type'=> $row['employee_type'],
            'first_name'=> $row['first_name'],
            'last_name'=> $row['last_name'],
            'company'=> $employer->company, //$row['company'],
            //'branch_id'=> $row['branch_id'],
            'branch_id' => $branch ? $branch->id : null,
            'position'=> $position->id, //$row['position'],
            'email'=> $row['email'],
            'password'=> FacadesHash::make($password),// $row['password'],
            'phone'=> $row['phone'],
            'date_of_birth'=> $row['date_of_birth'],
            'street'=> $row['street'],
            'city'=> $row['city'],
            'town'=> $row['town'],
            'postcode'=> $row['postcode'],
            //'country_id'=> $row['country_id'],
            'country_id' => $country ? $country->id : null,
            'tin'=> $row['tin'],
            'fnpf'=> $row['fnpf'],
            'bank'=> $row['bank'],
            'account_number'=> $row['account_number'],
            'licence_no'=> $row['licence_no'],
            'licence_expiry_date'=> $row['licence_expiry_date'],
            'passport_no'=> $row['passport_no'],
            'passport_expiry_date'=> $row['passport_expiry_date'],
            'image'=> $row['image'],

            //'date' => $row['date'],
        ]);
    }
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
