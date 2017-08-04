<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public $table="trips";
    protected $fillable=['start_place_lat','start_place_lng','title','start_date','end_date','status','sum_member','cover'];
    public function plan(){
    	return $this->hasMany('App\Plan');
    }
    public function comment(){
    	return $this->hasMany('App\Comment');
    }
    public function follow(){
    	return $this->hasMany('App\Follow');
    }
    public function join(){
    	return $this->hasMany('App\Join');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
