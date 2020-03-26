<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TempatSampah extends Model
{

    use Notifiable;

    protected $fillable = [
        'namalokasi', 'latitude', 'longitude', 'status', 'id_pimpinan_ecoranger', 'id_petugas_lapangan'
    ];

    protected $table = 'tempat_sampah';
}
