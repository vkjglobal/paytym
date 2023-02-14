<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $table = "attendance";
    protected $fillable = [
        'user_id','check_in','check_out','status','date',
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
