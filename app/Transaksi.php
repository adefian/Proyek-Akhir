<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'masyarakat_id', 'point_id', 'nama'
    ];

    public function Point()
    {
        return $this->belongsTo('App\Point', 'point_id');
    }

    public function Masyarakat()
    {
        return $this->belongsTo('App\Masyarakat', 'point_id');
    }
}
