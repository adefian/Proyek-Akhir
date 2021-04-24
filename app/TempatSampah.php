<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TempatSampah extends Model
{

    use Notifiable;

    protected $fillable = [
        'nama', 'latitude', 'longitude', 'status', 'user_id', 'file_gambar',
    ];

    protected $table = 'tempat_sampah';

    public function petugasygmenambahkan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
