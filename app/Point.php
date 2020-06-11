<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'point';

    protected $fillable = [
        'nilai', 'kode_reward', 'tempat_sampah_id', 'masyarakat_id'
    ];

    
    public function oleh()
    {
        return $this->belongsTo('App\Masyarakat', 'masyarakat_id');
    }

    public function dari_tempatsampah()
    {
        return $this->belongsTo('App\TempatSampah', 'tempat_sampah_id');
    }
}
