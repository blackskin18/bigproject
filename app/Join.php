<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    public $table="joins";
    protected $fillable=['trip_id','user_id','message','status'];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function trip(){
    	return $this->belongsTo('App\Trip');
    }
}
