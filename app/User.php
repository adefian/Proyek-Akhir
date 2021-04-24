<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "user";

    public function masyarakat() {
    
        return $this->belongsTo('App\Masyarakat','id');
    }
       public function pimpinanecoranger() {
    
        return $this->belongsTo('App\PimpinanEcoranger','id');
    }

     public function feedback() {
    
        return $this->belongsTo('App\Feedback','id');
    }
   
   public function poin() {
    
        return $this->belongsTo('App\Poin','id');
    }
       public function transaksi() {
    
        return $this->belongsTo('App\Transaksi','id');
    }

    //membuat fungsi isPimpinan untuk Pimpinan
    public function isPimpinan(){
        //jika role_name=pimpinanecoranger maka benar
        if($this->role == 'pimpinanecoranger'){
            return true;
        }
            return false;
    }
    
    //membuat fungsi isPetugaslapangan untuk Petugaslapangan
    public function isPetugaslapangan(){
        //jika role_name=Petugaslapangan maka benar
        if($this->role == 'petugaslapangan'){
            return true;
        }
            return false;
    }

    public function isKomunitas()
    {
        if($this->role == 'komunitas'){
            return true;
        }
            return false;
    }
    
    public function isPimpinanKomunitas()
    {
        if($this->role == 'pimpinankomunitas'){
            return true;
        }
            return false;
    }
}

