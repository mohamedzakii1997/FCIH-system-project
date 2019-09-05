<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Rules\ValidCourse;
use App\Article;
use App\Registration;
use App\Student;
use Illuminate\Validation\Rule;
use App\Course;
use DB;
use File;
use Storage;
use App\Resourse;
use Illuminate\Support\Facades\Hash;
class professorController extends Controller
{	
	function __construct(){
		$this->middleware('auth:professor');
	}
    public function addArticle(Request $request){
    	if($request->isMethod('post')){
    		$this->validate($request,[
    			'header'=>'required|max:100|min:5|string',
    			'description' =>'required|max:1000|min:15|string'
    		]);
    		auth('professor')->user()->addArticle($request->input('header'),$request->input('description'));
    		return redirect('articles/all')->with(['message'=>'A New Article Has Been Added Successfully']);
    	}
    	return view('articles/addArticle');
    }
    public function updateArticle(Request $request,$id){
    	$article=Article::findOrFail($id);
    	if($request->isMethod('post')){
    		$this->validate($request,[
    			'header'=>'required|max:100|min:5|string',
    			'description' =>'required|max:1000|min:15|string'
    		]);
    		auth('professor')->user()->updateArticle($article,$request->input('header'),$request->input('description'));
    		return redirect('articles/all')->with(['message'=>'The Article Has Been Updated Successfully']);
    	}
    	return view('articles/updateArticle',compact('article'));
    }

    public function getmynotification(){
    $arr=auth('professor')->user()->getmynotification();

 return response()->json($arr);
    }

    public function updateNotificationNumbers(Request $request){
     if($request->action =='update'){
     
     foreach (auth('professor')->user()->unreadNotifications as $notif) {
           $notif->markAsRead();
     }
    }

  }

    public function showfiles(Request $request)
    {   
        $validdata=Validator::make($request->all(),[
            'id'=>['required','integer','digits_between:1,10','exists:courses,id',new ValidCourse(auth('professor')->user()->id,0)]
        ]);
        if($validdata->fails()){
            return response()->json(['reply' =>$validdata->errors()->all()]);
        }
        $lecturefiles= Resourse::where('courseId','=',$request->id)->where('type','lecture')->get();
        $sectionfiles= Resourse::where('courseId','=',$request->id)->where('type','section')->get();
        $allfiles=array();
$allfiles[]='';
        foreach($lecturefiles as $file){
         $filename=explode('/',$file->path);
$allfiles[0].='<div style="width:70%;overflow:auto;display:inline-block;height:40px">'.$filename[1].'</div>
<span style="float:right">
<a href="'.url('/professor/deletefiles?id='.$file->id).'" class="btn btn-danger" onclick="return confirm('."'Are You Sure To Delete This File')".
'">Delete</a></span>';
}

$allfiles[]='';
        foreach($sectionfiles as $file){
         $filename=explode('/',$file->path);
$allfiles[1].='<div style="overflow:auto;height:40px">'.$filename[1].'</div>';


}
    return response()->json($allfiles);
     }

        public function deletefile(Request $request)
    { 
        $validdata=Validator::make($request->all(),[
            'id'=>['required','integer','digits_between:1,10','exists:resourses,id']
        ]);
        if($validdata->fails()){
            return back()->withErrors($validdata);
        }
        $path= DB::select('select path from resourses where id='.$request->id);
         Storage::delete($path[0]->path);
         Resourse::where('id', '=', $request->id)->delete();
         return redirect('professor/all')->with(['message'=>'File Deleted Successfully']);
    }
        public function showAllcourse()
    {
        $courses=auth('professor')->user()->courses;


        return view('professor.showcourse',compact('courses'));
    }

        public function showstudent($id)
    {   if(!DB::table('course_professor')->where('professorId',auth('professor')->user()->id)->where('courseId',$id)->count()){
            return back()->withErrors(['message'=>'Please Enter Valid Course']);
        }
        $student_info=Registration::where('courseId',$id)->get();
        return view('professor.showstudent',compact('student_info','id'));

    }

        public function assignStudentGrade(Request $request)

    {
        $student=Registration::where('studentId',$request->student_id)->where('courseId', $request->course_id)->firstOrFail();
        $this->validate($request,['student_id'=>'required|integer|digits_between:1,10|exists:students,id',
        'course_id'=>'required|integer|digits_between:1,10|exists:courses,id',
        'student_grade'=>'required|integer|digits_between:1,2|min:1|max:'.$student->course->midtermGrade
    ]);
        Registration::where('studentId',$request->student_id)->where('courseId', $request->course_id)->update(['midtermGrade'=>$request->student_grade]);
        return redirect('professor/students/'.$request->course_id)->with(['message'=>'Grade Has Beed Added Successfully']);
    }

        public function uploadfile(Request $request)
    {
            $validdata=Validator::make($request->all(),[
            'cid'=>['required','integer','digits_between:1,10','exists:courses,id',new ValidCourse(auth('professor')->user()->id,0)],
            'file'=>'required|file'
        ]);
        if($validdata->fails()){
            return back()->withErrors($validdata);
        }            
            $course=Course::findOrFail($request->cid);
            $path=Storage::putFileAs($course->id,$request->file('file'),$request->file('file')->getClientOriginalName());
            if(Resourse::where('path',$path)->count())
                return redirect('professor/all')->withErrors(['message'=>'You Uploaded This File Before. You Can Change The Name Of The File']);
            else{
                Resourse::insert(['courseId'=>$course->id,'type'=>'lecture','path'=>$path]);
                return redirect('professor/all')->with(['message'=>'File Uploaded Successfully']);
            }
    }
    public function showmytable(){
 
 $result= auth('professor')->user()->showMyTable();
 $mylectures=$result[1];
 $maxes=$result[0];
return view('professor.showmytable',compact('maxes','mylectures'));
    }
    public function changePassword(Request $request)
{  

    if($request->isMethod('post')){
        $request->validate([
            'current-password'=>'required',
            'new-password'=>'required|min:10|max:50|confirmed',
            'new-password_confirmation'=>'required'
        ]);
        if (!(Hash::check($request->get('current-password'), auth('professor')->user()->password))) {
            // The passwords matches
            return redirect()->back()->withErrors(["error"=> "Your current password does not matches with the password you provided."]);
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->withErrors(["error"=>"New Password cannot be same as your current password. Please choose a different password."]);
        }

    auth('professor')->user()->changePassword($request);
    return redirect('professor/editpassword')->with(['message'=>'the password has been changed']);
}
    return view('professor.editpassword');
}

public function editProfile(Request $request)
{
     if($request->isMethod('post')){
             $request->validate([
            'email' => ['required','email','min:10','max:50','unique:students,email','unique:admins,email','unique:assistants,email',Rule::unique('professors')->ignore(auth('professor')->user()->id)],
            'file'=>'nullable|image'
        ]);
        if($request->hasFile('file'))
        {       
            $image = $request->file('file');
            Storage::delete(auth('professor')->user()->profilePicture);
            $path=Storage::disk('public')->putFile('professors/'.auth('professor')->user()->id,$image);          
        }
        else{
         $path=auth('professor')->user()->profilePicture;
        }
     auth('professor')->user()->editProfile($request->email,$path);
     return redirect('professor/editprofile')->with(['message'=>'Profile Edited']);
    }
     return view('professor.editprofile');
}


}
