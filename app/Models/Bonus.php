<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Employer;
use App\Models\Branch;
use App\Models\EmployerBusiness;


class Bonus extends Model
{
    use HasFactory;

    public $table = 'bonus';

    public function employer(){
        return $this->belongsTo(Employer::class,'employer_id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'type_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class,'type_id');
    }

    public function business(){
        return $this->belongsTo(EmployerBusiness::class,'type_id');
    }
    public function employee(){
        return $this->belongsTo(User::class,'type_id');
    }
}
