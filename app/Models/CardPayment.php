<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    use HasFactory;

    public function plan()
    {
        return $this->belongsTo(Subscription::class, 'plan_id');
    }
}
