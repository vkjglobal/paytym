<?php

namespace App\Exports\Employer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentExport implements FromCollection, WithMapping
// 
{
    protected $bank;
    protected $bankname;
    protected $flag;
    protected $id;
    protected $employees;

    public function __construct($bankid, $bank, $flag, $id, $employees)
    {
        $this->bank = $bankid;
        $this->bankname = $bank;
        $this->flag = $flag;
        $this->id = $id;
        $this->employees = $employees;
    }


    // public function headings(): array
    // {
    //     // return [
    //     //     // '#',
    //     //     'Bank Name',
    //     //     'Account Number',
    //     //     'Amount',
    //     //     'Salary',
    //     //     'First Name',
    //     //     'Last Name',
    //     // ];
    // }
    public function collection()
    {
        $flag = $this->flag;
        $id = $this->id;
        if ($flag == "business") {
            foreach ($id as  $id) {
                $data = User::with(['payroll_latest', 'split_payment'])
                    ->where('employer_id', Auth::guard('employer')->id())
                    ->where('status', '1')
                    ->where('business_id', $id)->get();
            }
        } else if ($flag == "branch") {
            foreach ($id as $id) {
                $data = User::with(['payroll_latest', 'split_payment'])
                    ->where('employer_id', Auth::guard('employer')->id())
                    ->where('status', '1')
                    ->where('branch_id', $id)->get();
            }
        } else if ($flag == "department") {
            foreach ($id as $id) {
                $data = User::with(['payroll_latest', 'split_payment'])
                    ->where('employer_id', Auth::guard('employer')->id())
                    ->where('status', '1')
                    ->where('department_id', $id)->get();
            }
        } else if ($flag == "all" || $flag == "others") {
            $data = $this->employees;
        }
        return $data;
    }
    public function map($row): array
    {

        static $index = 0;
        return [
            // ++$index,
            $row->bank,
            $row->account_number,
          //  optional(optional($row)->payroll_latest)->net_salary,
            $row->split_payment_bank(),
            "Wages",
            $row->first_name . ' ' . $row->last_name,
        ];
    }
}
