<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exceptional_request extends Model
{
    public $timestamps=false;
    protected $primaryKey='studentId';

    public function course(){
    	return $this->belongsTo('App\Course','courseId');
    }
    public function student(){
    	return $this->belongsTo('App\Student','studentId');
    }
}
