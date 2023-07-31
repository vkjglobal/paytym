<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollBudget extends Model
{
    use HasFactory;

    // public $table = 'payroll_budgets';

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function payroll()
    {
        return $this->hasMany(Payroll::class, 'employer_id', 'employer_id');
    }
    
    public function total_budget()
    {
        return $this->payroll()->whereYear('end_date', $this->year)->sum('paid_salary');
    }
}
