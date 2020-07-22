<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecobrick extends Model
{
    protected $table = 'ecobrick';

    protected $fillable = [
        'nama_pengirimsaran', 'foto_diusulkan' , 'foto_diaplikasikan', 'keterangan', 'level', 'user_id'
    ];

    public function ygmenambahkan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function ambilFoto()
    {
        if (!$this->foto_diaplikasikan) {
            return asset('assets/img/ecobrick/ecobrick.jpg');
        }

        return asset('assets/img/ecobrick/'.$this->foto_diaplikasikan);
    }
}
