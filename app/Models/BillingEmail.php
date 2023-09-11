<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingEmail extends Model
{
    use HasFactory;
    public $table = "billing_emails";
    protected $fillable = [
        'name',
        'email'
 ];

}
