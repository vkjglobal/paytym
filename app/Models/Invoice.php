<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function plan()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function custom_plan()
    {
        return $this->belongsTo(CustomSubscription::class);
    }
}
