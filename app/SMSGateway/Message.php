<?php

namespace App\SMSGateway;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'sender',
        'receipent',
        'content',
        'type',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
