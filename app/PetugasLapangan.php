<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasLapangan extends Model
{
    protected $fillable = [
        'nama', 'nohp', 'alamat', 'wilayah', 'id_user','id_pimpinan_ecoranger'
    ];

    protected $table = 'petugas_lapangan';

    public function petugasygmengisi()
    {
        return $this->belongsTo('App\User','id_pimpinan_ecoranger');
    }
    public function akun()
    {
        return $this->belongsTo('App\User','id_user');
    }
}
