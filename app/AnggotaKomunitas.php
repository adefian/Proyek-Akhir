<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaKomunitas extends Model
{
    protected $table = 'anggota_komunitas';

    protected $fillable = [
        'nama', 'nohp', 'alamat', 'jenis_kelamin', 'level', 'user_id', 'komunitas_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function daerahygdipilih()
    {
        return $this->belongsTo('App\Komunitas','komunitas_id');
    }
}
