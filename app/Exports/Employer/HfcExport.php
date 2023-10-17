<?php

namespace App\Exports\Employer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HfcExport implements FromCollection, WithMapping
// 
{
    protected $bank;
    protected $bankname;
    protected $flag;
    protected $id;

    public function __construct($bankid,$bank,$flag,$id)
    {
        $this->bank = $bankid;
        $this->bankname = $bank;
        $this->flag = $flag;
        $this->id = $id;
    }

    
    public function headings(): array
    {
        return [
            'BANK',
            'ACCOUNTNUMBER',
            'ACCOUNTNAME',
            'AMOUNT',
            'NARRATION'
        ];
    }
    public function collection()
    {
        $flag=$this->flag;
        $id=$this->id;
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
        } else if ($flag == "all") {
            $data = User::with(['payroll_latest', 'split_payment'])->where('employer_id', Auth::guard('employer')->id())->where('status', '1')->get();

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
            $row->first_name.' '.$row->last_name,  
           // $row->amount,
            $row->split_payment_bank(),
            "Test",
        ];
    }
}
