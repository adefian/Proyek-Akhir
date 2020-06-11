<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TempatSampah extends Model
{

    use Notifiable;

    protected $fillable = [
        'namalokasi', 'latitude', 'longitude', 'status', 'user_id', 'foto',
    ];

    protected $table = 'tempat_sampah';

    public function petugasygmenambahkan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    
}
