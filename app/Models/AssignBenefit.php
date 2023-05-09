<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignBenefit extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function benefit()
    {
        return $this->belongsTo(Benefit::class, 'benefit_id');
    }
}
