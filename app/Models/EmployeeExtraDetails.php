<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExtraDetails extends Model
{
    use HasFactory;

    protected $table = 'employee_extra_details';

    public function users()
    {
        return $this->belongsTo(User::class,'employee_id');
    }

}
