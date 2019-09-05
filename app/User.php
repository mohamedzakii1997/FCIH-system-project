<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function changePassword(Request $request){
    
        $this->password = bcrypt($request->get('new-password'));
        $this->save();       
	}
    public function editProfile($email,$path){
    $this->email =$email;
    $this->profilePicture =$path;
    $this->save(); 
    }
}
