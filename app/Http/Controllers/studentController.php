<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Result;
use App\Registration;
use App\Student;
use Illuminate\Validation\Rule;
use App\Exceptional_request;
use App\Lecture;
use App\Section;
use App\Course_evaluation;
use Storage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PuchNotification;
use Notification;
use App\Department;
use Validator;
use App\Admin;
use App\Resourse;
use App\Setting;

class studentController extends Controller
{
    function __construct(){
    	$this->middleware('auth');
    }

    public function account(){
    	return view('student.account');
    }
    public function showregister(){
    	if(Setting::findOrFail(1)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    	$openCourses=auth()->user()->getOpenCourses();
        $registrations=Registration::where('studentId',auth()->user()->id)->pluck('courseId');
    	return view('student.register',compact('openCourses','registrations'));
    }

    public function register($id){
        if(Setting::findOrFail(1)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
        $target=Course::findOrFail($id);
        $openCourses=auth()->user()->getOpenCourses();
        $coursesId=array();
        foreach($openCourses as $course){
            $coursesId[]=$course->id;
        }
        if(in_array($target->id,$coursesId)){
            if(Registration::where('studentId',auth()->user()->id)->where('courseId',$id)->count()) // hwa asln msglha el term da
                return back()->withErrors(['message'=>'This Course Is Already Registered']);
            if(Exceptional_request::where('studentId',auth()->user()->id)->count()&&Exceptional_request::find(auth()->user()->id)->answer){
                $exrequest=Exceptional_request::findOrFail(auth()->user()->id);
                if($target->id==$exrequest->courseId||Registration::where('courseId',$exrequest->courseId)->count()){
                    if(Registration::join('courses','registrations.courseId','=','courses.id')->Where('studentId',auth()->user()->id)->sum('hours') + $target->hours>21)
                        return back()->withErrors(['message'=>'You Can not exceed 21 Hour With the Exceptional Course']);
                    else{
                        if((!$target->category) &&($target->hours+Result::join('courses','course_id','=','courses.id')->where('rate','!=','F')->where('student_id',auth()->user()->id)->where('departmentId',$target->departmentId)->where('category',0)->sum('hours')+Registration::join('courses','registrations.courseId','=','courses.id')->Where('studentId',auth()->user()->id)->where('departmentId',$target->departmentId)->where('category',0)->sum('hours')>$target->department->optional))
                            return back()->withErrors(['message'=>'You Can not exceed '.$target->department->optional.' Hours Of Total Optional Courses Hours For '.$target->department->name]);
                        auth()->user()->register($target->id);
                        return redirect('/student/showregister')->with(['message'=>'You Registered '.$target->englishName.' Successfully']);
                    }
                }

            }
            if(Registration::join('courses','registrations.courseId','=','courses.id')->Where('studentId',auth()->user()->id)->sum('hours') + $target->hours>18)
                return back()->withErrors(['message'=>'You Can not exceed 18 Hour Without Exceptional Course']);
            else{ 
                if((!$target->category) &&($target->hours+Result::join('courses','course_id','=','courses.id')->where('rate','!=','F')->where('student_id',auth()->user()->id)->where('departmentId',$target->departmentId)->where('category',0)->sum('hours')+Registration::join('courses','registrations.courseId','=','courses.id')->Where('studentId',auth()->user()->id)->where('departmentId',$target->departmentId)->where('category',0)->sum('hours')>$target->department->optional))
                            return back()->withErrors(['message'=>'You Can not exceed '.$target->department->optional.' Hours Of Total Optional Courses Hours For '.$target->department->name]);
                auth()->user()->register($target->id);
                return redirect('/student/showregister')->with(['message'=>'You Registered '.$target->englishName.' Successfully']);
            }
        }
        return back()->withErrors(['message'=>'Please Enter Valid Course Which You Passed It\'s Prerequisite Course']);
    }
    public function unregister($id){
        if(Setting::findOrFail(1)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
        $registration=Registration::where('studentId',auth()->user()->id)->where('courseId',$id)->firstOrFail();
        if(Course_evaluation::where('studentId',auth()->user()->id)->where('courseId',$id)->count()){
            Course_evaluation::where('studentId',auth()->user()->id)->where('courseId',$id)->delete();
        }
        Registration::where('studentId',auth()->user()->id)->where('courseId',$id)->delete();
        return redirect('/student/showregister')->with(['message'=>'You UnRegistered '.$registration->course->englishName.' Successfully']);
    }
     public function getmynotification(){
      $arr=auth('web')->user()->getmynotification();

      return response()->json($arr);
    }

  public function updateNotificationNumbers(Request $request){
     if($request->action =='update'){
     
     foreach (auth('web')->user()->unreadNotifications as $notif) {
           $notif->markAsRead();
     }
    }

  }
  public function showExceptionalRequests(){
    if(Setting::findOrFail(3)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    $request=Exceptional_request::where('studentId',auth()->user()->id)->first();
    if($request){
        if($request->answer)
            return redirect('student/account')->with(['message'=>'Your Request Has Been Accepted']);
        elseif($request->answer===0)
            return redirect('student/account')->withErrors(['message'=>'Your Request Has Been Rejected']);
        elseif(!$request->answer)
            return redirect('student/account')->with(['message'=>'Your Request On Hold Please Wait']);
    }else{
        $openCourses=auth()->user()->getOpenCourses();
        return view('student/exceptionalRequests',compact('openCourses'));
    }
  }

  public function sendExceptionalRequest(Request $request){
    if(Setting::findOrFail(3)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    $exrequest=Exceptional_request::where('studentId',auth()->user()->id)->first();
    if($exrequest){
        if($exrequest->answer)
            return redirect('student/account')->with(['message'=>'Your Request Has Been Accepted You Can Register Your Requested Course Now']);
        elseif($exrequest->answer===0)
            return redirect('student/account')->withErrors(['message'=>'Your Request Has Been Rejected Sorry :(']);
        elseif(!$exrequest->answer)
            return redirect('student/account')->with(['message'=>'Your Request On Hold Please Wait Or Come Back Later']);
    }else{
        $openCourses=auth()->user()->getOpenCourses();
        $coursesId=array();
        foreach($openCourses as $course){
            $coursesId[]=$course->id;
        }
        $data=$request->validate([
            'courseId' =>['required','integer',Rule::in($coursesId)],
            'reason'=>'string|in:Needed To Finish My Last Semester,Needed to Register a Department Next Semester,My GPA More Than 3.4',
            'message'=>'nullable|min:5|max:1000'
        ]);
        auth()->user()->sencExceptionalRequest($data);
        $notificationData=['studentName'=>auth()->user()->englishName,'reason'=>$data['reason']];
        $admins=Admin::all();
                Notification::send($admins, new PuchNotification($notificationData));
        return redirect('student/account')->with(['message'=>'You Request Has Been Sent Successfully']);
    }
  }
  public function showCourses(){
    if(Setting::findOrFail(4)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    $registrations=Registration::where('studentId',auth()->user()->id)->get();
    return view('student.mycourses',compact('registrations'));
  }
  public function showoverAllTable(){
    if(Setting::findOrFail(2)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
  $lecturedays=[];
  $copys=[];
  $maxes=[];
 for ($i=0; $i < 6 ; $i++) { 
  $lecturedays[$i]=Lecture::where('day',$i)->orderBy('time')->get();
  $copys[$i]=Lecture::where('day',$i)->orderBy('time')->get();   
 }
 




for ($i=0; $i <6 ; $i++) { 
    
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

            }
$maxes[$i]=$max;
}


//return $lecturedays[5][0]->time;



return view('studentlectures.overAllLectures',compact('lecturedays','maxes'));
}



public function showMyTable(){
    if(Setting::findOrFail(2)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
$mycourses = auth('web')->user()->courses;
$courses_ids=[];
if($mycourses){
foreach($mycourses as $key ){
  $courses_ids[]=$key->id;
}
}

/*$lec=Course::with(['lectures' => function($query)
{
    $query->whereIn('id',$courses_ids);
}])->get();*/
$mylectures=[];
$merge;
$sorted;
$copys=[];
$maxes=[];
for($i=0;$i<6;$i++){
$lec=Lecture::whereIn('courseId',$courses_ids)->where('day',$i)->get();
$sec=Section::whereIn('courseId',$courses_ids)->where('day',$i)->get();
    
//$merge=$lec->merge($sec);
foreach ($sec as $key ) {
    # code...
    $lec[]=$key;
}
$merge=$lec;
$sorted=$merge->sortBy('time');
$mylectures[$i]=$sorted->values();
$copys[$i]=$merge->sortBy('time');
$copys[$i]=$copys[$i]->values();
}


for ($i=0; $i <6 ; $i++) { 
    
$lecturesCopy=$copys[$i];
//return var_dump($lecturesCopy);
if($copys[$i]->count()){
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







return view('studentlectures.mytable',compact('mylectures','maxes'));

}
public function showoverAllSections(){
    if(Setting::findOrFail(2)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
$sectiondays=[];
  $copys=[];
  $maxes=[];
 for ($i=0; $i < 6 ; $i++) { 
  $sectiondays[$i]=Section::where('day',$i)->orderBy('time')->get();
  $copys[$i]=Section::where('day',$i)->orderBy('time')->get();   
 }
 

for ($i=0; $i <6 ; $i++) { 
    
$sectionCopy=$copys[$i];
//return var_dump($lecturesCopy);
 if($copys[$i]->count()){
  $max=0;
  $currentmax=0;
  $lastSection=null;
  for($k=0;$k<$sectionCopy->count(); $k++){
            if(empty($lastSection)){
                        $lastSection=$sectionCopy[$k];
                        $sectionCopy->forget($k);
                        $k--;
                        $sectionCopy=$sectionCopy->values();
                        $max++;
                        $currentmax++;
                    }
            else{
                if($sectionCopy[$k]->time >=$lastSection->time && $sectionCopy[$k]->time<($lastSection->time+$lastSection->duration)){
                    if($max==$currentmax)
                        $currentmax++;
                        $max++;
                }
                else{
                        $lastSection=$sectionCopy[$k];
                        $sectionCopy->forget($k);
                        $k--;
                        $sectionCopy=$sectionCopy->values();
                        $currentmax=1;
                    }
                }

            }}else{$max=0;}
$maxes[$i]=$max;
}



//return $maxes;
//return $sectiondays[0]->count(); 
return view('studentlectures.overallsections',compact('sectiondays','maxes'));
}

public function evaluate(Request $request){
    if(Setting::findOrFail(4)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    $registeredCoursesId=Registration::where('studentId',auth()->user()->id)->pluck('courseId')->toArray();
    $data=$request->validate([
        'courseId'=>['required','integer','exists:courses,id',Rule::in($registeredCoursesId)],
        'note'=>'nullable|string|min:5|max:70',
        'value'=>'required|integer|min:0|max:10'
    ]);
    if(Course_evaluation::where('studentId',auth()->user()->id)->where('courseId',$request->courseId)->count()){
        return back()->withErrors(['message'=>'You Evaluated This Course Before']);
    }else{
        auth()->user()->evaluate($data);
        return redirect('/student/showCourses')->with(['message'=>'You Evaluated Course Successfully']);
    }
}
public function changePassword(Request $request)
{  

    if($request->isMethod('post')){
        $request->validate([
            'current-password'=>'required',
            'new-password'=>'required|min:10|max:50|confirmed',
            'new-password_confirmation'=>'required'
        ]);
        if (!(Hash::check($request->get('current-password'), auth('web')->user()->password))) {
            // The passwords matches
            return redirect()->back()->withErrors(["error"=> "Your current password does not matches with the password you provided."]);
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->withErrors(["error"=>"New Password cannot be same as your current password. Please choose a different password."]);
        }

    auth('web')->user()->changePassword($request);
    return redirect('student/editpassword')->with(['message'=>'the password has been changed']);
}
    return view('student.editpassword');
}

public function editProfile(Request $request)
{
     if($request->isMethod('post')){
             $request->validate([
            'email' => ['required','email','min:10','max:50','unique:admins,email','unique:professors,email','unique:assistants,email',Rule::unique('students')->ignore(auth('web')->user()->id)],
            'file'=>'nullable|image'
        ]);
        if($request->hasFile('file'))
        {       
            $image = $request->file('file');
            Storage::delete(auth('web')->user()->profilePicture);
            $path=Storage::disk('public')->putFile('students/'.auth('web')->user()->id,$image);          
        }
        else{
         $path=auth('web')->user()->profilePicture;
        }
     auth('web')->user()->editProfile($request->email,$path);
     return redirect('student/editprofile')->with(['message'=>'Profile Edited']);
    }
     return view('student.editprofile');
}
public function registerDepartment(Request $request){
    if(Setting::findOrFail(5)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    if(auth()->user()->level>2){
        if(auth()->user()->mainDepartmentId<3){
            if($request->isMethod('post')){
                $request->validate([
                    'departmentId'=>'integer|exists:departments,id|min:3'
                ]);
                auth()->user()->mainDepartmentId=$request->departmentId;
                auth()->user()->save();
                return redirect('student/account')->with(['message'=>'You Registered '.auth()->user()->department->name.' Successfully']);
            }     
            $departments=Department::where('id','>','2')->get();
            return view('student.registerDepartment',compact('departments'));
        }else return back()->withErrors(['message' =>'You Already Registered A Department']); 
    }else return back()->withErrors(['message' =>' You Should Be Level 3 Or 4 To Register A Department']);
}

public function showTranscipt(){
    if(Setting::findOrFail(6)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    $allCourses=Course::all();
    $myresults=Result::where('student_id',auth()->user()->id)->get();

    return view('student.transcipt',[
            'myresults'=>$myresults,
            'allCourses'=>$allCourses,
            'general_mandatory'=>Department::findOrFail(1)->mandatory,
            'general_optional'=>Department::findOrFail(1)->optional,
            'uni_mandatory'=>Department::findOrFail(2)->mandatory,
            'uni_optional'=>Department::findOrFail(2)->optional,
            'spec_mandatory'=>Department::findOrFail(auth()->user()->mainDepartmentId)->mandatory,
            'spec_optional'=>Department::findOrFail(auth()->user()->mainDepartmentId)->optional
    ]);

}

public function showmyCourseResources(Request $request){
    if(Setting::findOrFail(4)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
$valid=Validator::make($request->all(),['courseId'=>['required','integer',Rule::exists('registrations')->where(function ($query){
   $query->where('studentId',auth()->user()->id);})
],]);
if($valid->fails()){
    return response()->json(['reply'=>$valid->errors()->all()]);
}
$studentCourse=Course::findOrFail($request->courseId);
$lectureFiles=$studentCourse->resources->where('type','lecture');
$sectionFiles=$studentCourse->resources->where('type','section');
$allfiles=[];
$allfiles[]='';
        foreach($lectureFiles as $file){
         $filename=explode('/',$file->path);
$allfiles[0].='<div style="overflow:auto;height:40px;display:inline-block;width:70%">'.$filename[1].'</div>
<span style="float:right">
<a href="'.url('/student/downloadfile//?id='.$file->id.'&&courseId='.$file->courseId).'" class="btn btn-primary"
>Download</a></span>';

}

$allfiles[]='';
        foreach($sectionFiles as $file){
         $filename=explode('/',$file->path);
$allfiles[1].='<div style="width:70%;overflow:auto;display:inline-block;height:40px">'.$filename[1].'</div>
<span style="float:right">
<a href="'.url('/student/downloadfile/?id='.$file->id.'&&courseId='.$file->courseId).'" class="btn btn-primary" 
>Dowload</a></span>';
}

return response()->json($allfiles);
}


public function downloadFile(Request $request){
    if(Setting::findOrFail(4)->status)
            return redirect('student/account')->withErrors(['message'=>'You Blocked From This Feature Currently. Come Back Later']);
    $this->validate($request,['id'=>'required|integer|digits_between:1,9|exists:resourses',
        'courseId'=>['required','integer',Rule::exists('registrations')->where(function ($query){
   $query->where('studentId',auth()->user()->id);})
]]);
    $resourse=Resourse::where('id',$request->id)->where('courseId',$request->courseId)->get();

return Storage::download($resourse[0]->path);
}

}
