<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    public $table = "group_chat";
    public $timestamps = false;
    use HasFactory;
}
