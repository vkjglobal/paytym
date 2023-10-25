<?php

namespace App\Imports;

use App\Models\FrcsEmployeeData;
use App\Models\User;
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

class FRCSUserImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    private $userId;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    /* public function __construct($userId)
    {
        $this->userId = $userId;
    } */

    public function model(array $row)
    {
        //dd($row['normal_pay']);
        $employer = Auth::guard('employer')->user();
        $userId = $this->userId;
        $frcsData = FrcsEmployeeData::where('employee_id', $userId)->first();
        $recentlyImportedEmployees = User::where('created_at', '>=', Carbon::now()->subMinute())->get();
        //dd($recentlyImportedEmployees);
       
        $user = $recentlyImportedEmployees->where('email', $row['email'])->first();
        if($user)
        {
        $user_id = $user->id;
        

        //foreach($recentlyImportedEmployees as $user)
        //{
           
        //}
        //if (!$frcsData) {

        return new FrcsEmployeeData([
            'employee_id' => $user_id, //$this->userId,
            'employer_id' => $employer->id,
            'tin' => $row['tin'],
            'date_of_birth'=> Carbon::createFromFormat('d-m-Y', $row['date_of_birth'])->format('Y-m-d'),//$row['date_of_birth'],
            
            'tax_code' => $row['tax_code'],
            'residence' => $row['residence'],
            'employment_start_date' => Carbon::createFromFormat('d-m-Y', $row['employment_start_date'])->format('Y-m-d'),
            'employment_end_date' => Carbon::createFromFormat('d-m-Y', $row['employment_end_date'])->format('Y-m-d'),
            'yeartodate_normal_pay' => $row['yeartodate_normal_pay'],
            'yeartodate_dir_rem_and_bonus_overtime' => $row['yeartodate_dir_rem_and_bonus_overtime'],
            'yeartodate_redundancy_payments' => $row['yeartodate_redundancy_payments'],
            'yeartodate_lumpsum_payments' => $row['yeartodate_lumpsum_payments'],
            'yeartodate_other_one_off_payments' =>$row['yeartodate_other_one_off_payments'],
            'yeartodate_income_tax' => $row['yeartodate_income_tax'],
            'yeartodate_srt' => $row['yeartodate_srt'],
            'yeartodate_ecal' =>$row['yeartodate_ecal'],
            'normal_pay' => $row['normal_pay'],
            'director_remuneration' => $row['director_remuneration'],
            'bonus_overtime' => $row['bonus_overtime'],
            'redundancy_payment_approval_no' => $row['redundancy_payment_approval_no'],
            'redundancy_payments' => $row['redundancy_payments'],
            'lumpsum_payment_approval_no' => $row['lumpsum_payment_approval_no'],
            'lumpsum_payment' => $row['lumpsum_payment'],
            'other_oneoff_payment_approval_no' => $row['other_oneoff_payment_approval_no'],
            'other_oneoff_payment' => $row['other_oneoff_payment'],
            'fnpf_deduction' => $row['fnpf_deduction'],
            'gross_up_employee' => $row['gross_up_employee'],
            'income_tax' => $row['income_tax'],
            'srt' => $row['srt'],
            'ecal' => $row['ecal'],

        ]);
    //}
   
             /*  $frcsData->employee_id = $this->userId;
            $frcsData->employer_id=  $employer->id;
            $frcsData->tin = $row['tin'];
            $frcsData->date_of_birth= Carbon::createFromFormat('d-m-Y', $row['date_of_birth'])->format('Y-m-d');//$row['date_of_birth'],
            $frcsData->tax_code = $row['tax_code'];
            $frcsData->residence =  $row['residence'];
            $frcsData->employment_start_date = Carbon::createFromFormat('d-m-Y', $row['employment_start_date'])->format('Y-m-d');
            $frcsData->employment_end_date = Carbon::createFromFormat('d-m-Y', $row['employment_end_date'])->format('Y-m-d');
            $frcsData->yeartodate_normal_pay = $row['yeartodate_normal_pay'];
            $frcsData->yeartodate_dir_rem_and_bonus_overtime = $row['yeartodate_dir_rem_and_bonus_overtime'];
            $frcsData->yeartodate_redundancy_payments = $row['yeartodate_redundancy_payments'];
            $frcsData->yeartodate_lumpsum_payments = $row['yeartodate_lumpsum_payments'];
            $frcsData->yeartodate_other_one_off_payments = $row['yeartodate_other_one_off_payments'];
            $frcsData->yeartodate_income_tax =$row['yeartodate_income_tax'];
            //'yeartodate_SRT' => $row['yeartodate_SRT'],
            //'yeartodate_ECAL' =>$row['yeartodate_ECAL'],
          'normal_pay' => $row['normal_pay'],
            'director_remuneration' => $row['director_remuneration'],
            'bonus_overtime' => $row['bonus_overtime'],
            'redundancy_payment_approval_no' => $row['redundancy_payment_approval_no'],
            'redundancy_payments' => $row['redundancy_payments'],
            'lumpsum_payment_approval_no' => $row['lumpsum_payment_approval_no'],
            'lumpsum_payment' => $row['lumpsum_payment'],
            'other_oneoff_payment_approval_no' => $row['other_oneoff_payment_approval_no'],
            'other_oneoff_payment' => $row['other_oneoff_payment'],
            'fnpf_deduction' => $row['fnpf_deduction'],
            'gross_up_employee' => $row['gross_up_employee'],
            'income_tax' => $row['income_tax'], */
            //'SRT' => $row['SRT'],
            //'ECAL' => $row['ECAL'],
    }

        
    
    }
    public function chunkSize(): int
    {
        return 2000;
    }
}
