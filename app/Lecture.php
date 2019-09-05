<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Appointment
{   
    protected $fillable=['professorId','courseId','location','duration'];

    public function course(){
    	return $this->belongsTo('App\Course','courseId');
    }
    public function professor(){
    	return $this->belongsTo('App\Professor','professorId');
    }
}