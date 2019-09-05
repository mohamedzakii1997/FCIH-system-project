<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptional_request;
use App\Course_evaluation;

class Student extends RegularUser
{
    //
    protected $fillable=['englishName','arabicName','username','password','email','SSN','gender'];
    public $timestamps=false;
    protected $primaryKey='id';

    public function department(){
        return $this->belongsTo('App\Department','mainDepartmentId');
    }
        public function courses()
    {
    return $this->belongsToMany('App\Course','registrations','studentId','courseId');
    }
    public function registrations(){
        return $this->hasMany('App\Registration','studentId');
    }

    public function register($courseId){
    	$registration = new Registration();
    	$registration->studentId=auth()->user()->id;
    	$registration->courseId=$courseId;
    	$registration->save();
    }
    public function getOpenCourses(){
        $courses=Course::where('available','1')->get();
        $results=Result::where('student_id',$this->id)->get();
        $openCourses=array();
        foreach ($courses as $course) {
            foreach($results as $result){
                if($result->course_id == $course->id && $result->rate!='F') continue 2;
            }
            if(!$course->prerequisiteCourseId){
                $openCourses[]=$course;
                continue;
            }
            foreach($results as $result){
                if($course->prerequisiteCourseId == $result->course_id && $result->rate!='F'){
                    if($course->departmentId==1||$course->departmentId==2||($course->departmentId>2 && $this->department->id==$course->departmentId))
                        $openCourses[]=$course;
                    break;
                }
            }
        }
        return $openCourses;
    }
    public function sencExceptionalRequest($data){
        $request= new Exceptional_request();
        $request->studentId=$this->id;
        $request->courseId=$data['courseId'];
        $request->reason=$data['reason'];
        if(isset($data['message']))
            $request->message=$data['message'];
        $request->save();
    }
    public function evaluate($data){
        $evaluation=new Course_evaluation();
        $evaluation->studentId=$this->id;
        $evaluation->courseId=$data['courseId'];
        $evaluation->value=$data['value'];
        $evaluation->note=$data['note'];
        $evaluation->save();
    }
}
