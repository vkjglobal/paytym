<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
           'name',
           'city',
           'town',
           'postcode',
           'country',
           'bank',
           'account_number',
           'qr_code'
    ];


    public function departments(){
        return $this->hasMany(Department::class);
    }

    public function business(){
        return $this->belongsTo(EmployerBusiness::class, 'employer_business_id');
    }

    public function banks()
    {
        return $this->belongsTo(BankModel::class,'bank');
    }

}
