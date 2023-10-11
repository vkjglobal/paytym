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

    public function __construct($bankid,$bank)
    {
        $this->bank = $bankid;
        $this->bankname = $bank;
       
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
        return  $this->bank;
        $data = User::with(['payroll_latest', 'split_payment'])->where('employer_id', Auth::guard('employer')->id())->where('status', '1')->get();
        return $data;
    }
    public function map($row): array
    {
        static $index = 0;
        return [
            ++$index,
            $row->bank,
            $row->account_number,
            // $row->amount,
            $row->split_payment_bank(),
            $row->first_name.' '.$row->last_name,  
        ];
    }
}
