<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $table="plans";
    protected $fillable=['trip_id','verhicle','active','place_start_lat','place_start_lng','place_end_lat','place_end_lng'];
    public function trip(){
    	return $this->belongsTo('App\Trip');
    }
}
