<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasKontenReward extends Model
{
    protected $table = "petugas_konten_reward";
	protected $fillable = [
        'nama','nohp','alamat','file_gambar','user_id'
    ];
    public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }

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
            return asset('foto_user/avatar-3.png');
        }

        return asset('foto_user/'.$this->file_gambar);
    }

}
