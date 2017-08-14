<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table="comments";
    protected $fillable=['parent_id','trip_id','user_id','text'];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function trip(){
    	return $this->belongsTo('App\Trip');
    }
    public function picture_comment(){
    	return $this->hasMany("App\PictureComment");
    }
}
