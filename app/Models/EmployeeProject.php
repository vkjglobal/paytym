<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'employee_id');
    }

    public function employees_project()
    {
        return $this->hasMany(EmployeeProject::class);
    }

}
