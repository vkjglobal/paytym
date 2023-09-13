<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public $table = "meeting";
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function meeting_attendees()
    {
        return $this->hasMany(MeetingAttendees::class,'meeting_id');
    }
}
