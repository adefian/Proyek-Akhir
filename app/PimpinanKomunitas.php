<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PimpinanKomunitas extends Model
{
    protected $table = 'pimpinan_komunitas';

    protected $fillable = [
        'id','nama','nohp','alamat','bio','file_gambar', 'komunitas_id'
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
    
    public function daerahygdipilih()
    {
        return $this->belongsTo('App\Komunitas', 'komunitas_id');
    }
}
