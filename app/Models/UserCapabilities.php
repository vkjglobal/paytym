<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class UserCapabilities extends Model
{
    use HasFactory;
    public $table = "user_capabilities";
    //public $timestamps = false;

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
