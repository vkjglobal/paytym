<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $table = "subscription";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'plan',
        'range_from',
        'range_to',
        'rate_per_employee',
        'rate_per_month'
 ];
}
