<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvidentFund extends Model
{
    use HasFactory;

    public $table = 'providentfunds';

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
