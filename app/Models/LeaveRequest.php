<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'type');
    }

    public function statusCheck()
    {
        if ($this->status == 0) {
            return "Pending";
        } else if ($this->status == 1) {
            return "Approved";
        } else if ($this->status == 2) {
            return "Rejected";
        }
    }
}
