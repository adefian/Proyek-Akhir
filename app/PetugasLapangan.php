<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasLapangan extends Model
{
    protected $table = 'petugas_lapangan';

    protected $fillable = [
        'nama', 'nohp', 'alamat', 'wilayah', 'user_id','pimpinan_ecoranger_id', 'file_gambar', 'bio'
    ];

    public function petugasygmenambahkan()
    {
        return $this->belongsTo('App\PimpinanEcoranger','pimpinan_ecoranger_id');
    }
    public function akun()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function ambilFoto()
    {
        if (!$this->file_gambar) {
            return asset('assets/img/avatar/avatar-2.png');
        }

        return asset('assets/img/avatar/'.$this->file_gambar);
    }
}
