<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplitPayment extends Model
{
    public $table = "split_payment";
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
