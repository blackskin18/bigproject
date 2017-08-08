<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Join;
use App\comment;
use App\Follow;
use App\Trip;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','introduce','phone','sex','verhicle','birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table='users';
    public function join(){
        return $this->hasMany('App\Join');  
    }
    public function comment(){
        return $this->hasMany('App\comment');
    }
    public function follow(){
        return $this->hasMany('App\Follow');
    }
    public function trip(){
        return $this->hasMany('App\Trip');
    }
}
