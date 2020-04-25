<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PimpinanEcoranger extends Model
{
    protected $table = 'pimpinan_ecoranger';

    protected $fillable = [
        'id','nama','nohp','alamat','bio','foto'
    ];

    public function ambilFoto()
    {
        if (!$this->foto) {
            return asset('assets/img/avatar/avatar-3.png');
        }

        return asset('assets/img/avatar/'.$this->foto);
    }

    public function pimpinan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

