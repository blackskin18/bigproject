<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PictureComment extends Model
{
    public $table="picture_comments";
    public $fillable=['comment_id','picture'];
    public function comment(){
    	return $this->belongsTo("App\comment");
    }
}
