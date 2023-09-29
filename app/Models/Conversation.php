<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function message()
    {
        return $this->belongsTo(Message::class,'message_id');
    }
}
