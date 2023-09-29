<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Message;
use App\Models\Conversation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_message_time' => 'datetime'
    ];
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'sender_id');
    }
    public function isOnline()
    {
        if (!$this->last_seen_at) {
            return false;
        }

        // Define a threshold (e.g., 2 minutes) to consider the user as online
        $threshold = now()->subMinutes(2);

        return $this->last_seen_at > $threshold;
    }
}
