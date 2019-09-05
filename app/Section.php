<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Appointment
{
    public function course(){
        return $this->belongsTo('App\Course','courseId');
    }
    public function assistant(){
        return $this->belongsTo('App\Assistant','assistantId');
    }
}
