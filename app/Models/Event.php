<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function business(){
        return $this->belongsTo(EmployerBusiness::class,'business_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
