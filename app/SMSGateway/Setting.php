<?php

namespace App\SMSGateway;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value'
    ];
}
