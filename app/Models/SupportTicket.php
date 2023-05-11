<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function employer(){
        return $this->belongsTo(Employer::class);
    }
    public function reply(){
        return $this->hasMany(SupportTicketReply::class);
    }
}
