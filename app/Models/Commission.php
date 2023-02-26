<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
