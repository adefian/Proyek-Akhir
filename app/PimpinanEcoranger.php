<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PimpinanEcoranger extends Model
{
    protected $table = 'pimpinan_ecoranger';

    protected $fillable = [
        'id','nama','nohp','alamat','bio','file_gambar'
    ];

    public function ambilFoto()
    {
        if (!$this->file_gambar) {
            return asset('assets/img/avatar/avatar-3.png');
        }

        return asset('assets/img/avatar/'.$this->file_gambar);
    }

    public function pimpinan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }

}

