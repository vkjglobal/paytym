<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChatMembers extends Model
{
    public $table = "group_chat_members";
    public $timestamps = false;
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
    public function group()
    {
        return $this->belongsTo(GroupChat::class, 'group_chat_id');
    }
    
}
