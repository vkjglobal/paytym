<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function project(){

        return $this->belongsTo(Project::class);
    }

    public function business(){

        return $this->belongsTo(EmployerBusiness::class);
    }

    public function department(){

        return $this->belongsTo(Department::class);
    }
    public function branch(){

        return $this->belongsTo(Branch::class,'branch_id');
    }

     
    public function job_type(){

        return $this->belongsTo(JobType::class,'job_id');
    }
}
