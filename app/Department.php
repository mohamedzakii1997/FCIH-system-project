<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {
    public $timestamps=false;
    public $table='departments';

    public function students(){
    	return $this->hasMany('App\Student','mainDepartmentId');
    }
}