<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	public $timestamps = false;
    public function professor(){
    	return $this->belongsTo('App\Professor','professor_id');
    }
}
