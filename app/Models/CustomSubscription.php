<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSubscription extends Model
{
    public $table="custom_plan";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'plan',
        'employer_id',
        'range_from',
        'range_to',
        'rate_per_employee',
        'rate_per_month'
 ];


    public function employer()
{
    return $this->belongsTo(Employer::class, 'employer_id', 'id');
}
}
