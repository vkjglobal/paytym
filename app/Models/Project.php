<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Department;
use App\Models\EmployerBusiness;

class Project extends Model
{
    use HasFactory;
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function business()
    {
        return $this->belongsTo(EmployerBusiness::class);
    }

    public function employeeproject()
    {
        return $this->hasMany(EmployeeProject::class);
    }

}
