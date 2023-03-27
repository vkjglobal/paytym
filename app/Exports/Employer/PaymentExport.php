<?php

namespace App\Exports\Employer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentExport implements FromCollection, WithHeadings
// WithMapping
{
    public function headings(): array
    {
        return [
            // '#',
            'Bank Name',
            'Account Number',
            'Amount',
            'Salary',
            'First Name',
            'Last Name',
        ];
    }
    public function collection()
    {
        $data = DB::table('users')
            ->join('payrolls', 'users.id', '=', 'payrolls.user_id')
            ->select('users.bank', 'users.account_number','payrolls.paid_salary', 'payrolls.base_salary', 'users.first_name','users.last_name')
            ->where('users.status', 1)->where('payrolls.status', 0)->get();

        return $data;
    }
    // public function map($row): array
    // {
    //     static $index = 0;
    //     return [
    //         ++$index,
    //         $row->bank,
    //         $row->account_number,
    //         $row->paid_salary,
    //         $row->base_salary,
    //         $row->first_name,
    //         $row->last_name,  
    //     ];
    // }
}
