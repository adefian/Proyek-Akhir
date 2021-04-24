<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Token extends Model
{
    
    use Notifiable;

    protected $fillable = [
        'name', 'token',
    ];

    protected $table = 'token';

}
