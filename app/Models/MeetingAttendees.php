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
    // public function meeting_details()
    // {
    //     return $this->meetings();
    // }
   
    public function users(){

        return $this->belongsTo(User::class,'attendee_id');
    }
}
