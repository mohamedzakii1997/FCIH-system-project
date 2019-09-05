<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    public $timestamps=false;
    public $table='courses';

    public function department(){
    	return $this->belongsTo('App\Department','departmentId');
    }
    public function prerequisiteCourse(){
    	return $this->belongsTo('App\Course','prerequisiteCourseId');
    }
    public function evaluations(){
    	return $this->hasMany('App\Course_evaluation','courseId');
    }
    public function students(){
        return $this->belongsToMany('App\Student','registrations','courseId','studentId');
    }
    public function Resources(){
        return $this->hasMany('App\Resourse','courseId');
    }
}