<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends RegularUser
{
    //
    public $timestamps = false;
    protected $fillable=['englishName','arabicName','username','password','email','SSN','salary','gender','mainDepartmentId'];
    public function addArticle($header,$description){
    	$article=new Article();
		$article->header=$header;
		$article->description=$description;
		$article->professor_id=$this->id;
		$article->save();
    }
    public function updateArticle($article,$header,$description){
		$article->header=$header;
		$article->description=$description;
		$article->save();
    }
    public function department(){
        return $this->belongsTo('App\Department','mainDepartmentId');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Course','course_professor','professorId','courseId');
    }

      public function showMyTable(){
    $lecturedays=[];
    $copys=[];
    $maxes=[];
 for ($i=0; $i < 6 ; $i++) { 
     $lecturedays[$i]=Lecture::where('professorId',$this->id)->where('day',$i)->orderBy('time')->get();
      $copys[$i]=Lecture::where('professorId',$this->id)->where('day',$i)->orderBy('time')->get();   
     }
 




for ($i=0; $i <6 ; $i++) { 
if($copys[$i]->count()){

$lecturesCopy=$copys[$i];
//return var_dump($lecturesCopy);
  $max=0;
  $currentmax=0;
  $lastLecture=null;
  for($k=0;$k<$lecturesCopy->count(); $k++){
            if(empty($lastLecture)){
                        $lastLecture=$lecturesCopy[$k];
                        $lecturesCopy->forget($k);
                        $k--;
                        $lecturesCopy=$lecturesCopy->values();
                        $max++;
                        $currentmax++;
                    }
            else{
                if($lecturesCopy[$k]->time >=$lastLecture->time && $lecturesCopy[$k]->time<($lastLecture->time+$lastLecture->duration)){
                    if($max==$currentmax)
                        $currentmax++;
                        $max++;
                }
                else{
                        $lastLecture=$lecturesCopy[$k];
                        $lecturesCopy->forget($k);
                        $k--;
                        $lecturesCopy=$lecturesCopy->values();
                        $currentmax=1;
                    }
                }

            }}
            else{$max=0;}
$maxes[$i]=$max;
}


$result=[];
$result[]=$maxes;
$result[]=$lecturedays;










  return $result;
    }
}
