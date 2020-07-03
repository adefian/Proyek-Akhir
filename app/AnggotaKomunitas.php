<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaKomunitas extends Model
{
    protected $table = 'anggota_komunitas';

    protected $fillable = [
        'nama', 'nohp', 'alamat', 'jenis_kelamin', 'level', 'user_id', 'komunitas_id', 'file_gambar', 'bio'
    ];

    public function akun()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function daerahygdipilih()
    {
        return $this->belongsTo('App\Komunitas','komunitas_id');
    }

    public function ambilFoto()
    {
        if (!$this->file_gambar) {
            return asset('assets/img/avatar/avatar-4.png');
        }

        return asset('assets/img/avatar/'.$this->file_gambar);
    }
}
