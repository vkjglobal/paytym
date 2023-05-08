<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingAttendees extends Model
{
    public $table = "meeting_attendees";
    use HasFactory;

    public function meetings(){

        return $this->belongsTo(Meeting::class,'meeting_id');
    }
}
