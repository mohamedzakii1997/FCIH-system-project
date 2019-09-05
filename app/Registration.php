<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    public $timestamps=false;

    public function course(){
    	return $this->belongsTo('App\Course','courseId');
    }
    public function student(){
    	return $this->belongsTo('App\student','studentId');
    }
}
