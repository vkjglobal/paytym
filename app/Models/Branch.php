<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
           'name',
           'city',
           'town',
           'postcode',
           'country',
           'bank',
           'account_number',
           'qr_code'
    ];
}
