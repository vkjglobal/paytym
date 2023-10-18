<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'leave_type',
        'no_of_days_allowed',
        'country_id',
        'employer_id'
        
        
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
