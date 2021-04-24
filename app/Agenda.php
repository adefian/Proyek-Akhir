<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $fillable = [
        'nama', 'keterangan', 'jenis_agenda', 'tanggal', 'user_id', 'komunitas_id', 'file_gambar'
    ];

    public function petugasygmenambahkan()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function komunitas()
    {
        return $this->belongsTo('App\Komunitas', 'komunitas_id');
    }

    public function ambilGambar()
    {
        if(!$this->file_gambar){
            return asset('agenda/default.jpg');
        }else{
            return asset('agenda/'.$this->file_gambar);
        }
    }
}
