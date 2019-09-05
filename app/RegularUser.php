<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class RegularUser extends User
{
    use Notifiable;
    //
    public function getmynotification(){
    	$output='';


    foreach ($this->Notifications()->take(5)->get() as $notif) {

  $output.='<a class="dropdown-item" href="#" onclick="JSalert('."'".$notif->data['description']."')".'">'.$notif->data['header'].'</a>';
    
    }

    $arr[]=$output;
    $arr[]=count($this->unreadNotifications);
    return $arr;
    }
}
