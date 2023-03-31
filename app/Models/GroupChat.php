<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    public $table = "group_chat";
    public $timestamps = false;
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function members()
    {
        return $this->hasMany(GroupChatMembers::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class, 'group_chat_id');
    }
}

