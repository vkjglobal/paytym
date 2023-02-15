<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignAllowance extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function allowance()
    {
        return $this->belongsTo(Allowance::class, 'allowance_id');
    }

}
