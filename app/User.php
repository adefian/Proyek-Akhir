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
        'nama', 'email', 'password', 'role', 
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

    // public function role()
    // {
    //     return $this->belongsTo('App\Role', 'id_role');
    // }

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
}
