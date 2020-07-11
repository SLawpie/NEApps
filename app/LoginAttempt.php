<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $fillable = [
        'ip',
        'user_agent', 
        'user_name',
        'success'
    ];
}
