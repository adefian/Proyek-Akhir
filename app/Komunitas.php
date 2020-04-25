<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
    protected $table = 'komunitas';

    protected $fillable = [
        'email','daerah','keterangan','level','latitude','longitude','user_id'
    ];

    public function petugasygmenambahkan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
