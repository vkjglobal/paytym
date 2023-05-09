<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    protected $fillable = [
            'dep_name',
            'branch_id'
    ];
    public $timestamps = false;
    use HasFactory;

    // public function leaves(){
    //     $leaves = LeaveRequest::where('employer_id', Auth::guard('employer'))->where('status', '1')->get();
    //     return $this->belongsTo(Branch::class,'branch_id','id');
    // }

    public function leaveRequests()
    {
        return $this->hasManyThrough(LeaveRequest::class, User::class);
    }

    public function leavesCount()
    {
        return $this->leaveRequests()->get();
        // return $this->employee()->where('department_id', $this->id)->get();
    }

    public function employee()
    {
        return $this->hasMany(User::class);
    }

    public function active_employee()
    {
        return $this->employee()->where('status', '1')->count();
    }

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
