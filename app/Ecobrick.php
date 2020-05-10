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
}
