<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $table="follows";
    protected $fillable=['trip_id','user_id'];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function trip(){
    	return $this->belongsTo('App\trip');
    }
}
