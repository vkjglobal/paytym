<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerBusiness extends Model
{
    use HasFactory;

    public function payslipsetting()
    {
        return $this->hasOne(PayslipSetting::class);
    }
    public function payrollsetting()
    {
        return $this->hasOne(PayrollSetting::class);
    }

    public function banks()
    {
        return $this->belongsTo(BankModel::class,'bank');
    }
}
