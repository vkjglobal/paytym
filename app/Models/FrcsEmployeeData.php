<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrcsEmployeeData extends Model
{
    use HasFactory;
    public $table = "employee_frcs_data";
    protected $fillable = [
        'employer_id',
        'employee_id',
        'tin',
        'date_of_birth',
        'tax_code',
        'residence',
        'employment_start_date',
        'employment_end_date',
        'yeartodate_normal_pay',
        'yeartodate_dir_rem_and_bonus_overtime',
        'yeartodate_redundancy_payments',
        'yeartodate_lumpsum_payments',
        'yeartodate_other_one_off_payments',
        'yeartodate_income_tax',
        'yeartodate_srt',
        'yeartodate_ecal',
        'normal_pay',
        'director_remuneration',
        'bonus_overtime',
        'redundancy_payment_approval_no',
        'redundancy_payments',
        'lumpsum_payment_approval_no',
        'lumpsum_payment',
        'other_oneoff_payment_approval_no',
        'other_oneoff_payment',
        'fnpf_deduction',
        'gross_up_employee',
        'income_tax',
        'srt',
        'ecal',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }


}
