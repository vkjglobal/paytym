<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class Department extends Model
{
    protected $fillable = [
            'dep_name',
            'branch_id'
    ];
    public $timestamps = false;
    use HasFactory;




    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
