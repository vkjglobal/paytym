<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAdvance extends Model
{
    public $table = "payment_advance";
   use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
