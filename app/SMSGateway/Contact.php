<?php

namespace App\SMSGateway;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'number'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
