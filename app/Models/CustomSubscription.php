<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSubscription extends Model
{
    public $table="custom_plan";
    public $timestamps = false;
    use HasFactory;


    public function employer()
{
    return $this->belongsTo(Employer::class, 'employer_id', 'id');
}
}
