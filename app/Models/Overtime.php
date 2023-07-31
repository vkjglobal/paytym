<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    public $table = "overtime";
    use HasFactory;

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'employee_id');
    }


}
