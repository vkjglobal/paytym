<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payroll extends Model
{
    use HasFactory;

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->payslip_number = Str::uuid()->toString();
    //     });
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
