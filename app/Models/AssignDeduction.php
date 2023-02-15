<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDeduction extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function deduction()
    {
        return $this->belongsTo(Deduction::class, 'deduction_id');
    }
}
