<?php

namespace App\Exports\Employer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MycashExport implements FromCollection, WithMapping
// WithMapping, WithHeadings
{
    // public function headings(): array
    // {
    //     return [
    //         // '#',
    //         'Bank Name',
    //         'Account Number',
    //         'Amount',
    //         'Salary',
    //         'First Name',
    //         'Last Name',
    //     ];
    // }
    public function collection()
    {
        // $data = DB::table('users')
        // ->join('split_payment', 'users.id', '=', 'split_payment.employee_id')
        // ->select('users.phone', 'split_payment.amount','users.first_name', 'users.last_name')
        // ->where('users.status', 1)->where('split_payment.status', 0)->where('split_payment.payment_wallet', '0')
        // ->where('users.employer_id', Auth::guard('employer')->id())->where('split_payment.employer_id', Auth::guard('employer')->id())
        // ->get();

        // $data = DB::table('users')
        // ->join('split_payment', 'users.id', '=', 'split_payment.employee_id')
        // ->select('users.phone', 'split_payment.mycash','users.first_name', 'users.last_name')
        // ->where('users.status', 1)->where('split_payment.status', 0)
        // ->where('users.employer_id', Auth::guard('employer')->id())->where('split_payment.employer_id', Auth::guard('employer')->id())
        // ->get();

        $data = User::with('payroll_latest', 'split_payment')->where('employer_id', Auth::guard('employer')->id())->get();

        return $data;
    }
    public function map($row): array
    {
        // static $index = 0;
        return [
            $row->phone,
            // $row->amount,
            // $row->payroll_latest->paid_salary * ($row->split_payment->mycash/100),
            $row->first_name.' '.$row->last_name,  
        ];
    }
}

