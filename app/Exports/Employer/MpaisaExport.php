<?php

namespace App\Exports\Employer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MpaisaExport implements FromCollection, WithMapping
// WithMapping, WithHeadings
{

    public function collection()
    {
        // $data = DB::table('users')
        //     ->join('payrolls', 'users.id', '=', 'payrolls.user_id')
        //     ->select('users.bank', 'users.account_number','payrolls.paid_salary', 'payrolls.base_salary', 'users.first_name','users.last_name')
        //     ->where('users.status', 1)->where('payrolls.status', 0)->get();
        
            // $data = DB::table('users')
            // ->join('split_payment', 'users.id', '=', 'split_payment.employee_id')
            // ->select('users.phone', 'split_payment.mpaisa','users.first_name', 'users.last_name')
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
            // $row->payroll_latest->paid_salary * ($row->split_payment->mpaisa/100),
            $row->first_name.' '.$row->last_name,  
        ];
    }
}
