<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_evaluation extends Model
{
    //
    public $timestamps=false;
    public function student(){
    	return $this->belongsTo('App\Student','studentId');
    }
}
