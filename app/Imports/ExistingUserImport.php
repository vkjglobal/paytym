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
use App\Jobs\EmployeeCreationPushNotification;
use App\Mail\EmployeeCredentialsMail;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;
use Illuminate\Support\Facades\Session;

class ExistingUserImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employer = Auth::guard('employer')->user();
        if (isset($row['email']) && !empty($row['email'])) {
        $existingEmployee = User::where('email',$row['email'])->first();
   
        //dd($existingEmployee);
       //dd($row['annual_leaves_taken']);
        $businessName = $row['business_name'];
        $business = EmployerBusiness::where('name', $businessName)->where('employer_id',$employer->id)->first();
        if($business)
        {
            $branch = Branch::where('name', $row['branch_name'])->where('employer_id',$employer->id)->where('employer_business_id',$business->id)->first();
            $departmentName = $row['department_name'];
            $department = Department::where('dep_name', $departmentName)->where('employer_id',$employer->id)->where('branch_id',$branch->id)->first();
        }
        else
        { 
            $branch= 0;
            $department = 0;
        }
        $country = Country::where('name', $row['country_name'])->first();
        
        $position= Role::where('role_name', $row['position'])->where('employer_id',$employer->id)->first();
        //$password =  Str::random(8);
        if (isset($row['image']) && !empty($row['image'])) {
            $imageValue = $row['image'];
        } else {
            $imageValue = null; // or 'default.jpg' or any other default value
        }
       
        if(is_null($existingEmployee))
        {
        if(!$employer)
        {
            return null;
        }
        else
        {
        return new User([
            'employer_id' => $employer->id, //$employer ? $employer->id : null,
            'job_title'    => $row['job_title'], 
            'employment_start_date' => Carbon::createFromFormat('d-m-Y', $row['employment_start_date'])->format('Y-m-d'),
            'employment_end_date' => Carbon::createFromFormat('d-m-Y', $row['employment_end_date'])->format('Y-m-d'),
            'check_in_default' => $row['check_in_default'],
            'check_out_default' => $row['check_out_default'],
            'check_out_requred' => ($row['check_out_requred'] == 'Yes') ? '1' : (($row['check_out_requred'] == 'No') ? '0' : '0'),
            'bank_branch_name' => $row['bank_branch_name'],
            'business_id' => $business ? $business->id : null,
            'department_id' => $department ? $department->id : 0,
            'salary_type'=> ($row['salary_type'] == 'Fixed') ? '0' : (($row['salary_type'] == 'Hourly') ? '1' : null),
            'rate'=> $row['rate'],
            'pay_period' => ($row['pay_period'] == 'Weekly') ? '0' : (($row['pay_period'] == 'Fortnightly') ? '1' : (($row['pay_period'] == 'Monthly') ? '2' : null)),
            'workdays_per_week'=> $row['workdays_per_week'],
            'total_hours_per_week'=> $row['total_hours_per_week'],
            'extra_hours_at_base_rate'=> $row['extra_hours_at_base_rate'],
            'employee_type' => ($row['employee_type'] == 'Attachee') ? '0' : (($row['employee_type'] == 'Apprenticeship') ? '1' : (($row['employee_type'] == 'Probationary Period') ? '2' : (($row['employee_type'] == 'Permanent') ? '3' : null))),

            'first_name'=> $row['first_name'],
            'last_name'=> $row['last_name'],
            'company'=> $employer->company, //$row['company'],  
            'branch_id' => $branch ? $branch->id : 0,
            'position'=> $position ? $position->id : 0, //$position->id, //$row['position'],
            'email'=> $row['email'],
            'phone'=> $row['phone'],
            'date_of_birth'=> Carbon::createFromFormat('d-m-Y', $row['date_of_birth'])->format('Y-m-d'),//$row['date_of_birth'],
            'street'=> $row['street'],
            'city'=> $row['city'],
            'town'=> $row['town'],
            'postcode'=> $row['postcode'],
            'country_id' => $country ? $country->id : null,
            'tin'=> $row['tin'],
            'fnpf'=> $row['fnpf'],
            'bank'=> $row['bank'],
            'account_number'=> $row['account_number'],
            'licence_no'=> $row['licence_no'],
            'licence_expiry_date'=> Carbon::createFromFormat('d-m-Y', $row['licence_expiry_date'])->format('Y-m-d'),//$row['licence_expiry_date'],
            'passport_no'=> $row['passport_no'],
            'passport_expiry_date'=> Carbon::createFromFormat('d-m-Y', $row['passport_expiry_date'])->format('Y-m-d'),//$row['passport_expiry_date'],
            'image'=> $imageValue,
            //'date' => $row['date'],
            'annual_leaves_taken' => $row['annual_leaves_taken'],
            'sick_leaves_taken' => $row['sick_leaves_taken'],
            'bereavement_leaves_taken' => $row['bereavement_leaves_taken'],
            'maternity_leaves_taken' => $row['maternity_leaves_taken'],
            'leave_without_pay' => $row['leave_without_pay'],
            'special_leave' => $row['special_leave'],
            'attendance_to_date' => $row['attendance_to_date'],
            'days_absent' => $row['days_absent'],
            'tax_code' => $row['tax_code'],


        ]);
       
    }
}
    Session::flash('msg', 'Employee with email ' . $row['email'] . ' already exists.');
    return null;

        }
        else
        {
        Session::flash('msg', 'Wrong file uploaded.');
        return null;
        }
    }
    public function chunkSize(): int
    {
        return 2000;
    }
}
