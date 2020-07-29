<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'point';

    protected $fillable = [
        'nilai', 'kode_reward', 'tempat_sampah_id', 'masyarakat_id','code_reward', 'status', 'status_salah'
    ];

    
    public function oleh()
    {
        return $this->belongsTo('App\Masyarakat', 'masyarakat_id');
    }

    public function dari_tempatsampah()
    {
        return $this->belongsTo('App\TempatSampah', 'tempat_sampah_id');
    }

    public function masyarakat() {
    
        return $this->belongsTo('App\Masyarakat','masyarakat_id','id');
    }
    public function user() {
    
        return $this->belongsTo('App\User','user_id','id');
    }
    public function tempat_sampah() {
    
        return $this->belongsTo('App\TempatSampah','tempat_sampah_id','id');
    }
}
