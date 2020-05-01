<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasLapangan extends Model
{
    protected $fillable = [
        'nama', 'nohp', 'alamat', 'wilayah', 'user_id','pimpinan_ecoranger_id'
    ];

    protected $table = 'petugas_lapangan';

    public function petugasygmenambahkan()
    {
        return $this->belongsTo('App\PimpinanEcoranger','pimpinan_ecoranger_id');
    }
    public function akun()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
