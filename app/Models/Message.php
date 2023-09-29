<?php

namespace App\Models;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime',
        'last_message_time' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
   
}
