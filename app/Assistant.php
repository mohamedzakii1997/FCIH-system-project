<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Worker
{
    public $timestamps = false;
    public function sections(){
        return $this->hasMany('App\Section', 'assistantId');
    }
    public function department(){
        return $this->belongsTo('App\Department','mainDepartmentId');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Course','assistant_course','assistantId','courseId');
    }

    public function showMyTable(){
    $lecturedays=[];
    $copys=[];
    $maxes=[];
 for ($i=0; $i < 6 ; $i++) { 
     $lecturedays[$i]=Section::where('assistantId',$this->id)->where('day',$i)->orderBy('time')->get();
      $copys[$i]=Section::where('assistantId',$this->id)->where('day',$i)->orderBy('time')->get();   
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
