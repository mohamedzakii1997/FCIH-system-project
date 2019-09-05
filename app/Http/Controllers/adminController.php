<?php
namespace App\Http\Controllers;
use App\Assistant;
use App\Section;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Student;
use App\Professor;
use App\Article;
use App\Course;
use App\Department;
use App\Lecture;
use Illuminate\Validation\Rule;
use App\Notifications\PuchNotification;
use Notification;
use App\Rules\ValidCourse;
use App\Resourse;
use Storage;
use File;
use Illuminate\Support\Facades\Hash;
use App\Exceptional_request;
use App\Registration;
use App\Result;
use App\Setting;
class adminController extends Controller
{
    function __construct(){
    	$this->middleware('auth:admin');
    }
    public function dashboard(){
      return view('admin.dashboard',
        ['student_count' => Student::count(),
          'professor_count'=>Professor::count(),
          'assistant_count'=>Assistant::count(),
          'course_count'=>Course::count(),
          'lecture_count'=>Lecture::count(),
          'section_count'=>Section::count(),
          'level2'=>Student::where('level',2)->orderBy('GPA','DESC')->take(10)->get(),
          'level3'=>Student::where('level',3)->orderBy('GPA','DESC')->take(40)->get(),
          'level4'=>Student::where('level',4)->orderBy('GPA','DESC')->take(40)->get(),
          'departments'=>Department::where('id','>',2)->get()
        ]);
    }
    public function deleteArticle($id){
    	$article=Article::findOrFail($id);
    	auth('admin')->user()->deleteArticle($article);
    	return redirect()->route('home')->with(['message'=>'Article Deleted successfully']);
    }

    public function addcourse(Request $request)
    {if($request->isMethod('POST'))
        {
            $messages=['finalGrade.max'=>'Final Grade Can not exceed Total Grade of the Course',
                        'midtermGrade.max'=>'Midterm Term Grade Can not exceed Total Grade - Final Grade'
                      ];
            $this->validate($request,[
                'englishName' =>'required|max:50|min:5|string',
                'arabicName'=>'required|max:50|min:5|string',
                'departmentId'=>'required|digits_between:1,10|integer|exists:departments,id',
                'available'=>'required|boolean',
                'hours'=>'required|integer|in:2,3,6',
                'courseCode'=>'required|max:8|alpha_num|unique:courses|min:3',
                'totalGrade'=>'required|digits_between:1,3|integer|min:50|max:200',
                'finalGrade'=>'required|digits_between:1,3|integer|min:50|max:'.$request->totalGrade,
                'midtermGrade'=>'required|digits_between:1,2|integer|max:'.strval($request->totalGrade-$request->finalGrade),
                'prerequisiteCourseId'=>'nullable|digits_between:1,10|integer|exists:courses,id',
                'category'=>'required|boolean'
            ],$messages);
            auth('admin')->user()->addcourse($request->input('englishName'),$request->input('arabicName'),
            $request->input('departmentId'),$request->input('hours'),$request->input('finalGrade')
        ,$request->input('totalGrade'),$request->input('prerequisiteCourseId'),$request->input('courseCode'),$request->input('available'),$request->input('midtermGrade'),$request->input('category'));
            return redirect('/admin/courses')->with(['message'=>'A New Course Has Been Added Successfully']);
        }
        $department=auth('admin')->user()->showdepartments();
        $courses=auth('admin')->user()->showCourses();
        return view('admin.Course.addcourse',compact('department'),compact('courses'));
    }
    
    public function showcourses()
    {
        $course=auth('admin')->user()->showCourses();
        return view('admin.Course.showcourse',compact('course'));
    }
    public function showcourse()
    {
      
        $courses=auth('admin')->user()->showcourse();
        return view('admin.Course.editcourse',compact('courses'));
    }
    public function deletecourse($id)
    {
        File::deleteDirectory(storage_path('app/'.$id));
        Resourse::where('courseId',$id)->delete();
        auth('admin')->user()->deleteCourse($id);
        return redirect('/admin/courses/')->with(['message'=>'Course Deleted Successfully']);
    }

    public function updatecourse(Request $request,$id)
    { 
        $course=Course::findOrFail($id);
        if($request->isMethod('POST'))
        {
            $messages=['finalGrade.max'=>'Final Grade Can not exceed Total Grade of the Course',
                        'midtermGrade.max'=>'Midterm Term Grade Can not exceed Total Grade - Final Grade'
                      ];
            $this->validate($request,[
                'englishName' =>'required|max:50|min:5|string',
                'arabicName'=>'required|max:50|min:5|string',
                'departmentId'=>'required|digits_between:1,10|integer|exists:departments,id',
                'available'=>'required|boolean',
                'hours'=>'required|integer|in:2,3,6',
                'courseCode'=>['required','alpha_num','max:8','min:3',Rule::unique('courses')->ignore($id)],
                'totalGrade'=>'required|digits_between:1,3|integer|min:50|max:200',
                'finalGrade'=>'required|digits_between:1,3|integer|min:50|max:'.$request->totalGrade,
                'midtermGrade'=>'required|digits_between:1,3|integer|max:'.strval($request->totalGrade-$request->finalGrade),
                'prerequisiteCourseId'=>['nullable','digits_between:1,10','integer','exists:courses,id',Rule::notIn([$id])],
                'category'=>'required|boolean'
            ],$messages);
            auth('admin')->user()->updateCourse($course,$request->input('englishName'),$request->input('arabicName'),$request->input('departmentId'),$request->input('hours'),$request->input('finalGrade'),$request->input('totalGrade'),$request->input('prerequisiteCourseId'),$request->input('courseCode'),$request->input('available'),$request->input('midtermGrade'),$request->input('category'));
            return redirect('/admin/courses')->with(['message'=>'A New Course Has Been Updated Successfully']);
        }
        $department=auth('admin')->user()->showdepartments();
        $courses=auth('admin')->user()->showCourses();
        return view('admin.Course.editcourse',['course' => $course,'department'=> $department,'courses'=>$courses]);
}

public function addDepartment(Request $request){
    if($request->isMethod('POST'))
    {
        $this->validate($request,[
            'name' =>'required|max:50|min:5|string',
            'symbol'=>'required|max:5|alpha|min:2',
            'optional'=>'required|integer|min:2|max:99'
        ]);
        auth('admin')->user()->addDepartment($request->input('name'),$request->input('symbol'),$request->input('optional'));
        return redirect('/admin/departments')->with(['message'=>'A New Department Has Been Added Successfully']);
    }
    return view('admin.Department.addDepartment');
}

public function updateDepartment(Request $request,$id){
    $department=Department::findOrFail($id);
    if($request->isMethod('POST'))
    {
        $this->validate($request,[
            'name' =>'required|max:50|min:5|string',
            'symbol'=>'required|max:4|alpha|min:2',
            'optional'=>'required|integer|min:2|max:99'
        ]);
        auth('admin')->user()->updateDepartment($department,$request->input('name'),$request->input('symbol'),$request->input('optional'));
        return redirect('/admin/departments')->with(['message'=>'A New Department Has Been Updated Successfully']);
    }
    return view('admin.Department.editDepartment',compact('department'));
}


public function showdepartments()
{
    $department=Department::where('id','>','2')->get();
    return view('admin.Department.showDepartment',compact('department'));
}

public function deleteDepartment($id)
{
    auth('admin')->user()->deleteDepartment($id);
    return redirect('/admin/departments/')->with(['message'=>'Department Deleted Successfully']);
}

public function showAllStudent(){
        $all=Student::paginate(10);
        return view('admin.students',['all_student'=>$all]);
    }
    public function addStudent(Request $request){
        if ($request->isMethod('post')){
        $validdata =$request->validate(
        ['englishName'=>'required|max:50|string|min:8',
         'arabicName'=>'required|max:50|min:8|string',
         'username'=>'required|max:30|min:8|alpha_num|unique:professors,username|unique:admins,username|
         unique:students,username|unique:assistants,username',
         'password'=>'required|max:30|min:8|alpha_num',
         'email'=>'required|max:50|email|unique:admins,email|unique:students,email|unique:professors,email,unique:assistants,email',
         'SSN'=>'required|digits_between:1,20|numeric',
         'gender'=>'required|in:Male,Female',
         'mainDepartmentId'=>'required|exists:departments,id|in:1'
        ]);
       $validdata['password']=bcrypt($validdata['password']);
       auth('admin')->user()->addStudent($validdata);
         return redirect('/admin/students/all')->with(['message'=>'A new Student has been added successfully']);

   }
       return view('admin.addstudent');
    }
   public function updateStudent(Request $request,$id){
       $student=Student::findOrFail($id);
       if($request->isMethod('post')){
       $validdata =$request->validate(
        ['englishName'=>'required|max:50|string|min:8',
         'arabicName'=>'required|max:50|min:8|string',
         'username'=>['required','max:30','min:8','alpha_num','unique:professors,username','unique:admins,username','unique:assistants,username'],Rule::unique('students')->ignore($id),
         'password'=>'nullable|max:30|min:8|alpha_num',
         'email'=>['required','max:50','email','unique:admins,email','unique:assistants,email','unique:professors,email'],Rule::unique('students')->ignore($id),
         'SSN'=>'required|digits_between:1,20|numeric',
         'gender'=>'required|in:Male,Female',
        ]);
       auth('admin')->user()->updateStudent($student,$validdata);
       return redirect('/admin/students/all')->with(['message'=>'A new Student has been Updated successfully']);
   }
   return view('admin.updatestudent',compact('student'));
    }
   public function deleteStudent($id){
      $student=Student::findOrFail($id);
      File::deleteDirectory(storage_path('app/public/students/'.$id));
      auth('admin')->user()->deleteStudent($student);
      return redirect('/admin/students/all')->with(['message'=>'A new Student has been deleted successfully']);
    }

    public function showAllProfessors(){    
      $profs=Professor::all();
      return view('admin.profs',compact('profs'));
    }
    public function addProfessor(Request $request){
    if($request->isMethod('post')){
    $validdata=$request->validate(
        ['englishName'=>'required|max:50|string|min:8',
         'arabicName'=>'required|max:50|min:8|string',
         'username'=>'required|max:30|min:8|alpha_num|unique:professors,username|unique:admins,username|
         unique:students,username|unique:assistants,username',
         'password'=>'required|max:30|min:8|alpha_num',
         'email'=>'required|max:50|email|unique:admins,email|unique:students,email|unique:professors,email|unique:assistants,email',
         'SSN'=>'required|digits_between:1,20|numeric',
         'gender'=>'required|in:Male,Female',
         'salary'=>'required|numeric|max:99999.99:min:1000',
         'mainDepartmentId'=>'required|integer|digits_between:1,10|exists:departments,id'
        ]);
    $validdata['password']=bcrypt($validdata['password']);
    auth('admin')->user()->addProfessor($validdata);
    return redirect('admin/professors/all')->with(['message'=>'A new Professor Has Been Added Successfully']);
  }
      $all=Department::all();
    return view('admin.addprof',compact('all'));
   } 

   public function updateProfessor(Request $request,$id){
     $prof=Professor::findOrFail($id);
     if($request->isMethod('post')){
     $validdata=$request->validate(
        ['englishName'=>'required|max:50|string|min:8',
         'arabicName'=>'required|max:50|min:8|string',
         'username'=>['required','max:30','min:8','alpha_num','unique:students,username','unique:admins,username','unique:assistants,username'],Rule::unique('professors')->ignore($id),
         'password'=>'max:12|min:8|alpha_num|nullable',
          'email'=>['required','max:50','email','unique:admins,email','unique:students,email','unique:assistants,email'],Rule::unique('professors')->ignore($id),
         'SSN'=>'required|digits_between:1,20|numeric',
         'gender'=>'required|in:Male,Female',
         'salary'=>'required|numeric|max:99999.99:min:1000',
        'mainDepartmentId'=>'required|integer|digits_between:1,10|exists:departments,id'
        ]);

     auth('admin')->user()->updateProfessor($prof,$validdata);
     return redirect('/admin/professors/all')->with(['message'=>'A new Professor Has Been Updated Successfully']);
   }
$all=Department::all();
return view('admin.updateprof',compact('prof'),compact('all'));
 }

 public function deleteProfessor($id){
  $prof=Professor::findOrFail($id);
  File::deleteDirectory(storage_path('app/public/professors/'.$id));
      auth('admin')->user()->deleteProfessor($prof);
   return redirect('admin/professors/all')->with(['message'=>'A Professor Has Been Deleted Successfully']); 
 }
  public function getCoursesIds(Request $request){
  //ajax validation 
$v=Validator::make($request->all(),['id'=>'required|integer|exists:professors,id|digits_between:1,10'
]);

if($v->fails()){
  return response()->json(['reply' =>$v->errors()->all()]);
}
$output='';
$registeredCourses = DB::table('course_professor')->where('professorId','=',$request->id)->pluck('courseId');
$unregisteredCourses =Course::whereNotIn('id',$registeredCourses)->where('available','1')->get();


foreach ($unregisteredCourses as $key) {
$output.='<option value="'.$key->id.'">'.$key->englishName.'</option>';
}
return response()->json($output); 
 }

  public function assignProf(Request $request){
  $this->validate($request,['prof_id'=>'required|integer|exists:professors,id|digits_between:1,10',
    'courseid'=>'required|integer|exists:courses,id|digits_between:1,10'
]);
  if(Course::where('id',$request->courseid)->where('available','1')->count()&& !DB::table('course_professor')->where('courseId',$request->courseid)->where('professorId',$request->prof_id)->count()){
  auth('admin')->user()->assignProf($request->courseid,$request->prof_id);
  return redirect('/admin/professors/all')->with(['message'=>'Professor Has Been Assigned To Course Successfully']);
}else{
  return redirect('/admin/professors/all')->withErrors(['message'=>'Please Enter Valid Course']);
}
 }
 
 public function showProfs_Courses(){
  $prof_courses = DB::table('course_professor')->select(['professorId','courseId','courseCode',DB::raw('professors.englishName as professorName'),DB::raw('courses.englishName as courseName'),'profilePicture'])->join('professors','professorId','professors.id')->join('courses','courseId','courses.id')->get();

return view('admin.profs_course',compact('prof_courses'));
 }
  public function deleteassign($id,$c_id){
auth('admin')->user()->deleteassign($id,$c_id);
return redirect('/admin/professors/showprofs')->with(['message'=>'Assignment Has been deleted Successfully']);
 }

 public function showAllLecture(){
  $all=Lecture::all();
  
  return view('admin.lectures',compact('all'));
}
public function addLecture(Request $request){
  if($request->isMethod('post')){
  $valid=$this->validate($request,[
     'professorId'=>'required|integer|exists:professors,id',
     'courseId'=> ['required','integer','exists:courses,id',new ValidCourse($request->professorId,0)],
     'duration'=>'required|integer|max:4|min:2',
     'time'=>'required|integer|max:18|min:8',
     'day'=>'required|integer|in:0,1,2,3,4,5',
     'location'=>'required|string|max:10'
   ]);
   auth('admin')->user()->addLecture($valid);
 return redirect('/admin/lectures/all')->with(['message'=>'New Lecture Has been Added Successfully']);
  }
  $courses=Course::where('available',1)->get();
  $profs=Professor::all();
  return view('admin.addlecture',compact('courses','profs'));
}
public function updateLecture(Request $request,$id){
$lecture=Lecture::findOrFail($id);
if($request->isMethod('post')){
  $valid= $this->validate($request,[
     'professorId'=>'required|integer|exists:professors,id',
     'courseId'=> ['required','integer','exists:courses,id',new ValidCourse($request->professorId,0)],
     'duration'=>'required|integer|max:4|min:2',
     'time'=>'required|integer|max:18|min:8',
     'day'=>'required|integer|in:0,1,2,3,4,5',
     'location'=>'required|string|max:10'
   ]);
auth('admin')->user()->updateLecture($lecture,$valid);
return redirect('admin/lectures/all')->with(['message'=>'New Lecture Has been Added Successfully']);
}
$profs=Professor::all();
$courses=Course::where('available',1)->get();
return view('admin.editlecture',['lecture'=>$lecture,'profs'=>$profs,'courses'=>$courses]);
}

public function deleteLecture($id){
  $lec=Lecture::findOrFail($id);
  auth('admin')->user()->deleteLecture($lec);
 return redirect('admin/lectures/all')->with(['message'=>'Lecture Has been Deleted Successfully']);
}

 public function deleteAssistant($id){
        $assistant=Assistant::findOrFail($id);
        File::deleteDirectory(storage_path('app/public/assistants/'.$id));
        auth('admin')->user()->deleteAssistant($assistant);
        return redirect('assistants/all')->with(['message'=>'Assistant Deleted successfully']);
    }

    public function deleteSection($id){

        $section=Section::findOrFail($id);
        auth('admin')->user()->deleteSection($section);
        return redirect('sections/all')->with(['message'=>'Section Deleted successfully']);

    }

public function addAssistant(Request $request){
    if($request->isMethod('post')){
        $validdata=$request->validate(
        ['englishName'=>'required|max:50|string|min:8',
         'arabicName'=>'required|max:50|min:8|string',
         'username'=>'required|max:30|min:8|alpha_num|unique:professors,username|unique:admins,username|unique:assistants,username|
         unique:students,username',
         'password'=>'required|max:30|min:8|alpha_num',
         'email'=>'required|max:50|email|unique:admins,email|unique:students,email|unique:professors,email|unique:assistants,email',
         'SSN'=>'required|digits_between:1,20|numeric',
         'gender'=>'required|in:Male,Female',
         'salary'=>'required|numeric|max:99999.99',
         'mainDepartmentId'=>'required|integer|digits_between:1,10|exists:departments,id'
        ]);
    $validdata['password']=bcrypt($validdata['password']);
    auth('admin')->user()->addAssistant($validdata);
        return redirect('assistants/all')->with(['message'=>'A New Assistant Has Been Added Successfully']);


    }

        $all=Department::all();
        return view('assistants.addAssistant',compact('all'));

}

public function addSection(Request $request){

    if($request->isMethod('post')){
        $valid=$this->validate($request,[
             'assistantId'=>'required|integer|exists:assistants,id',
             'courseId'=> ['required','integer','exists:courses,id',new ValidCourse($request->assistantId,1)],
             'duration'=>'required|integer|max:3|min:1',
             'time'=>'required|integer|max:19|min:8',
             'day'=>'required|integer|in:0,1,2,3,4,5',
             'location'=>'required|string|max:10'
           ]);
           auth('admin')->user()->addSection($valid);

        return redirect('sections/all')->with(['message'=>'A New Section Has Been Added Successfully']);
    }

    $assistants=Assistant::all();
    $courses=Course::where('available',1)->get();
    return view('sections.addSection',['assistants' =>$assistants,'courses'=>$courses]);

}




public function updateAssistant(Request $request,$id){

        $prof=Assistant::findOrFail($id);

    if($request->isMethod('post')){
        $validdata=$request->validate(
        ['englishName'=>'required|max:50|string|min:8',
         'arabicName'=>'required|max:50|min:8|string',
         'username'=>['required','max:30','min:8','alpha_num','unique:students,username','unique:admins,username','unique:professors,username'],Rule::unique('assistants')->ignore($id),
         'password'=>'max:12|min:8|alpha_num|nullable',
          'email'=>['required','max:50','email','unique:admins,email','unique:students,email','unique:professors,email'],Rule::unique('assistants')->ignore($id),
         'SSN'=>'required|digits_between:1,20|numeric',
         'gender'=>'required|in:Male,Female',
         'salary'=>'required|numeric|max:99999.99',
        'mainDepartmentId'=>'required|integer|digits_between:1,10|exists:departments,id'
        ]);
     auth('admin')->user()->updateAssistant($prof,$validdata);
        return redirect('assistants/all')->with(['message'=>'The Assistant Has Been Updated Successfully']);
    }
    $all=Department::all();
    return view('assistants.updateAssistant',compact('prof'),compact('all'));
}

public function updateSection(Request $request,$id){
        $section=Section::findOrFail($id);

    if($request->isMethod('post')){
          $valid= $this->validate($request,[
     'assistantId'=>'required|integer|exists:assistants,id',
     'courseId'=> ['required','integer','exists:courses,id',new ValidCourse($request->assistantId,1)],
     'duration'=>'required|integer|max:3|min:1',
     'time'=>'required|integer|max:19|min:8',
     'day'=>'required|integer|in:0,1,2,3,4,5',
     'location'=>'required|string|max:10'
   ]);
auth('admin')->user()->updateSection($section,$valid);
        return redirect('sections/all')->with(['message'=>'A New Section Has Been Updated Successfully']);

    }
    $assistants=Assistant::all();
    $courses=Course::where('available',1)->get();
    return view('sections.updateSection',['section' =>$section,'assistants' =>$assistants,'courses'=>$courses]);
}
    public function getassistants(){
        $assistants=Assistant::all();
        return view('assistants/assistants',compact('assistants'));

    }

    public function getsections(){
        $sections=Section::all();
        return view('sections/sections',compact('sections'));

    }

    public function getassistantsCoursesIds(Request $request){
        //ajax validation
        $v=Validator::make($request->all(),['id'=>'required|integer|exists:assistants,id',
        ]);
        if($v->fails()){return response()->json(['reply' =>$v->errors()->all()]);}
        $output='';
        $registeredCourses = DB::table('assistant_course')->where('assistantId','=',$request->id)->pluck('courseId');
        $unregisteredCourses =Course::whereNotIn('id',$registeredCourses)->where('available','1')->get();


        foreach ($unregisteredCourses as $key) {
        $output.='<option value="'.$key->id.'">'.$key->englishName.'</option>';
        }
        return response()->json($output);
    }
    public function assignassistant(Request $request){
      $this->validate($request,['ass_id'=>'required|integer|exists:assistants,id|digits_between:1,10',
            'courseid'=>'required|integer|exists:courses,id|digits_between:1,10'
        ]);
        if(Course::where('id',$request->courseid)->where('available','1')->count()&& !DB::table('assistant_course')->where('courseId',$request->courseid)->where('assistantId',$request->ass_id)->count()){
        auth('admin')->user()->assignassistant($request->ass_id,$request->courseid);
        return redirect('assistants/all')->with(['message'=>'A New Assistant Has Been Assigned To Course Successfully']);
        }else{
          return redirect('/assistants/all')->withErrors(['message'=>'Please Enter Valid Course']);
        }
    }

    public function showassistant_Courses(){
        $assis_courses = DB::table('assistant_course')->select(['assistantId','courseId','courseCode',DB::raw('assistants.englishName as assistantName'),DB::raw('courses.englishName as courseName'),'profilePicture'])->join('assistants','assistantId','assistants.id')->join('courses','courseId','courses.id')->get();
        return view('assistants.assistantscourses',compact('assis_courses'));

    }
    public function deleteAssistantassign($id,$c_id){
        auth('admin')->user()->deleteAssistantAssign($id,$c_id);
        return redirect('/assistants/showcourses')->with(['message'=>'Assignment Has Been deleted Successfully']);
    }

        public function notifyStudents(Request $request){
       if($request->isMethod('post')){
         
        $this->validate($request,['header'=>'required|string|max:50|min:5','description'=>'required|string|max:1000|min:15']);
        $arr=['header'=>$request->header,
        'description'=>$request->description];
         auth('admin')->user()->notifyStudents($arr);
       return redirect('/admin/students/all')->with(['message'=>'students Has Been notified Successfully']);
       }

      return view('admin.notifystudentsform');
    }

    public function notifyProfs(Request $request){
        
     if($request->isMethod('post')){
         
        $this->validate($request,['header'=>'required|string|max:50|min:5','description'=>'required|string|max:1000|min:15']);
        $arr=['header'=>$request->header,
        'description'=>$request->description];
         auth('admin')->user()->notifyProfs($arr);
       return redirect('/admin/professors/all')->with(['message'=>'professors Has Been notified Successfully']);
       }

      return view('admin.notifyprofsform');
    }

    public function notifyAsisstants(Request $request){
       
       if($request->isMethod('post')){
         
        $this->validate($request,['header'=>'required|string|max:50|min:5','description'=>'required|string|max:1000|min:15']);
        $arr=['header'=>$request->header,
        'description'=>$request->description];
        auth('admin')->user()->notifyAsisstants($arr);
       return redirect('/assistants/all')->with(['message'=>'assistants Has Been notified Successfully']);
       }

      return view('admin.notifyassistantsform');
    }
    public function showExceptionalRequests(){
      $requests=Exceptional_request::where('answer',null)->get();
      return view('admin.exceptionalRequests',compact('requests'));
    }

    public function answerExceptionalRequest(Request $request, $id){
      $exceptionalRequest=Exceptional_request::findOrFail($id);
      $request->validate([
        'result'=>'required|boolean'
      ]);
      if($request->result){
        $exceptionalRequest->answer=1;
      }else{
        $exceptionalRequest->answer=0;
      }
      $exceptionalRequest->save();
      return redirect('admin/exceptionalRequests')->with(['message'=>'Request Has Been Answered Successfully']);
    }

      public function showOverAllTable(){
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

            }}else{$max=0;}
$maxes[$i]=$max;
}


//return $lecturedays[5][0]->time;



return view('admin.overalltable',compact('lecturedays','maxes'));


    }

public function showOverallSections(){
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
return view('admin.overallsections',compact('sectiondays','maxes'));
}
public function showEvaluations($id){
  $course=Course::findOrFail($id);
  return view('admin.Course.evaluations',['evaluations'=>$course->evaluations]);
}

public function changePassword(Request $request)
{  

    if($request->isMethod('post')){
        $request->validate([
            'current-password'=>'required',
            'new-password'=>'required|min:10|max:50|confirmed',
            'new-password_confirmation'=>'required'
        ]);
        if (!(Hash::check($request->get('current-password'), auth('admin')->user()->password))) {
            // The passwords matches
            return redirect()->back()->withErrors(["error"=> "Your current password does not matches with the password you provided."]);
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->withErrors(["error"=>"New Password cannot be same as your current password. Please choose a different password."]);
        }

    auth('admin')->user()->changePassword($request);
    return redirect('admin/editpassword')->with(['message'=>'the password has been changed']);
}
    return view('admin.editpassword');
}



public function editProfile(Request $request)
{
     if($request->isMethod('post')){
             $request->validate([
            'email' => ['required','email','min:10','max:50','unique:students,email','unique:professors,email','unique:assistants,email',Rule::unique('admins')->ignore(auth('admin')->user()->id)],
            'file'=>'nullable|image'
        ]);
        if($request->hasFile('file'))
        {       
            $image = $request->file('file');
            Storage::delete(auth('admin')->user()->profilePicture);
            $path=Storage::disk('public')->putFile('admins/'.auth('admin')->user()->id,$image);          
        }
        else{
         $path=auth('admin')->user()->profilePicture;
        }
     auth('admin')->user()->editProfile($request->email,$path);
     return redirect('admin/editprofile')->with(['message'=>'Profile Edited']);
    }
     return view('admin.editprofile');
}
public function showAvailableCourseStudents($id){ 
$course=Course::where('available',1)->where('id',$id)->firstOrFail();
$students=$course->students;
return view('admin.assignstudentsfinal',compact('students','id'));
}

public function assignStudentFinal(Request $request){
  $request->validate([
    'cid'=>'required|integer|digits_between:1,10|min:1',
    'sid'=>'required|integer|digits_between:1,10|min:1'
  ]);
if(Registration::where('studentId',$request->sid)->where('courseId',$request->cid)->count()){
  $c_grade=Course::where('id',$request->cid)->value('finalGrade');

  $this->validate($request,['grade'=>'required|integer|min:0|max:'.$c_grade]);
 Registration::where('courseId',$request->cid)
 ->where('studentId',$request->sid)
 ->update(['fingalGrade'=>$request->grade]);
  return back()->with(['message'=>'the student final grade has been assigned']);
}else return back()->withErrors(['message'=>'The Student Did Not Registered This Course']);
}

public function supportTerm(){
  DB::beginTransaction();
try {

$all_registerations=Registration::all();
  $rate;
foreach ($all_registerations as $obj) {
$result= Result::where('course_Id',$obj->courseId)->where('student_Id',$obj->studentId)->where('rate','F')->count();
$totalGrade=$obj->fingalGrade+$obj->midtermGrade+$obj->classworkGrade;
$coursetotalgrade=Course::where('id',$obj->courseId)->value('totalGrade');
$resultgrade=($totalGrade/$coursetotalgrade)*100;
if($result){
  if($resultgrade <50){$rate='F';}
if($resultgrade >= 50 && $resultgrade < 60){$rate='D';}
elseif($resultgrade >=60 && $resultgrade <65){$rate='D+';}
elseif($resultgrade >= 64){
  $totalGrade=$coursetotalgrade*64/100;
}
$result=new Result();
  $result->course_Id=$obj->courseId;
  $result->student_Id=$obj->studentId;
  $result->grade=$totalGrade;
  $result->rate=$rate;
  $result->save();

}

else{
  $rates=['0-50'=>'F','50-60'=>'D','60-65'=>'D+','65-70'=>'C','70-75'=>'C+','75-80'=>'B','80-85'=>'B+','85-90'=>'A'
,'90-101'=>'A+'];
  $c_totalgrade=Course::where('id',$obj->courseId)->value('totalGrade');
$result_grade=($totalGrade/$c_totalgrade)*100;
foreach ($rates as $key => $value) {
  $between=explode('-',$key);
if($between[0] <= $result_grade && $result_grade < $between[1]){
             $rate=$value;
              break;
}
}

  $result=new Result();
  $result->course_Id=$obj->courseId;
  $result->student_Id=$obj->studentId;
  $result->grade=$totalGrade;
  $result->rate=$rate;
  $result->save();
}
}
// end for loop for caculate students results tested

// calculate the passed hours for 
$students=Student::all();
foreach($students as $obj){
$student_results=Result::where('student_id',$obj->id)->where('rate','!=','f')->get();
$course_ids=[];
foreach($student_results as $std){
$course_ids[]=$std->course_id;
}

$passed_hours=DB::table('courses')->select(DB::raw('sum(hours) as hours'))->whereIn('id',$course_ids)->get();
if($passed_hours[0]->hours)
$obj->hours=$passed_hours[0]->hours;
else $obj->hours=0;

if($obj->hours > 0 && $obj->hours <36){$obj->level=1;}
elseif($obj->hours >= 36 && $obj->hours <72){$obj->level=2;}
elseif($obj->hours >= 72 && $obj->hours <108){$obj->level=3;}
elseif ($obj->hours >= 108) {$obj->level=4;}

// caculate gpa
$rate_points=['F'=>1,'D'=>2,'D+'=>2.2,'C'=>2.5,'C+'=>2.75,'B'=>3.1,'B+'=>3.4,'A'=>3.75,'A+'=>4];
$student_courses=Result::where('student_id',$obj->id)->get();
$sum_points=0;
$sum_hours=0;
foreach ($student_courses as $key) {
$c_hours=Course::where('id',$key->course_id)->value('hours');
$sum_points+=$rate_points[$key->rate] * $c_hours;
$sum_hours+=$c_hours;
}
//return $sum_hours;
if(!$sum_hours)
$GPA=0;
else{
  $GPA= $sum_points / $sum_hours;
  $GPA = intval($GPA * 100) / 100;
}
$obj->GPA=$GPA;
$obj->save();
}//end caculation of hours and level for students

// loop on available courses tand delete its resourses
$courses=Course::where('available',1)->get();
foreach ($courses as $key) {
File::deleteDirectory(storage_path('app/'.$key->id));
DB::table('courses')->where('id',$key->id)->update(['available'=>0]);
}
Exceptional_request::truncate();   
Registration::truncate();
Lecture::truncate();
Section::truncate();
DB::table('course_evaluations')->truncate();
DB::table('course_professor')->truncate();
DB::table('assistant_course')->truncate();
Resourse::truncate();
} catch(ValidationException $e)
{
    // Rollback and then redirect
    // back to form with errors
    DB::rollback();
    return Redirect::to('admin/dashboard')
        ->withErrors( $e->getErrors())
        ->withInput();
} catch(\Exception $e)
{
    DB::rollback();
    throw $e;
}


DB::commit();
return redirect('admin/dashboard')->with(['message'=>'the term has been Approved']);


}//end function

public function search(Request $request){
$result;
$output='';
if($request->tabletype=='courses'){

if(empty($request->key)){
  $result=Course::all();
}
elseif(is_numeric($request->key)){
  $result=Course::where('id','LIKE','%'.$request->key.'%')->get();
}
elseif(is_string($request->key)){
   $result=Course::where('englishName','LIKE','%'.$request->key.'%')->get();
}

foreach ($result as $obj) {
$output.='<tr><td>'.$obj->englishName.'</td><td>'
         .$obj->courseCode.'</td><td>'
         .$obj->hours.'</td><td>'
         .$obj->department->symbol.'</td><td>'
         .$obj->available.'</td><td>';
         if($obj->category)
          $output.='Mandatory</td>';
        else
          $output.='Optional</td>';

         if(isset($obj->prerequisiteCourse))
           $output.= '<td>'.$obj->prerequisiteCourse->courseCode.'</td>';
          else  $output.='<td></td>';  

$output.= '<td><a href="'.url('/admin/updatecourse/'.$obj->id).'" class="btn btn-primary" ><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>'
          .' <a href="'.url('/admin/showEvaluations/'.$obj->id).'" class="btn btn-primary" ><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Evaluations</a>';
         
          if($obj->available){
            $output.=' <a href="'.url('/admin/showcoursestudents/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Students</a>';}
            
            $output.= ' <a href="'.url('/admin/courses/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure To Delete This Course')".'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';  
 

}
}

// search for students
elseif ($request->tabletype=='student') {
 if(empty($request->key)){
  $result=Student::all();
}
elseif(is_numeric($request->key)){
  $result=Student::where('id','LIKE','%'.$request->key.'%')->get();
}
elseif(is_string($request->key)){
   $result=Student::where('englishName','LIKE','%'.$request->key.'%')->get();
}

foreach ($result as $obj) {
$output.='<tr>
                  <td>'.$obj->id.'</td>
                  <td>'.$obj->englishName.'</td>
                   <td>'.$obj->email.'</td>
                  <td>'.$obj->level.'</td>
                  <td>'.$obj->username.'</td>
                  <td>'.$obj->department->name.'</td>
                  <td><img src="'.asset('storage/'.$obj->profilePicture).'" width="100" height="70" alt="-"></td>
          <td>
          <a href="'.url('admin/students/update/'.$obj->id).'" class="btn btn-primary" ><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>';
  $output.= '
  <a href="'.url('admin/students/delete/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure To Delete?')".'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></td></tr>';           
}
}

elseif ($request->tabletype=='professor') {
if(empty($request->key)){
  $result=Professor::all();
}
elseif(is_numeric($request->key)){
  $result=Professor::where('id','LIKE','%'.$request->key.'%')->get();
}
elseif(is_string($request->key)){
   $result=Professor::where('englishName','LIKE','%'.$request->key.'%')->get();
}

foreach ($result as $obj) {
$output.='<tr><td>'.$obj->englishName.'</td>
                   <td>'.$obj->email.'</td>
                  <td>'.$obj->salary.'</td>
                  <td>'.$obj->department->name.'</td>
                  <td><img src="'.asset('storage/'.$obj->profilePicture).'" width="100" height="70" alt="-"></td>
<td><a href="'.url('admin/professors/update/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getid('.$obj->id.')"><i class="fa fa-address-book" aria-hidden="true"></i> Assign</button>'.'
   <a href="'.url('admin/professors/delete/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure You Want To Delete')".'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td></tr>';     

}
 
}

elseif($request->tabletype=='assistant'){

if(empty($request->key)){
  $result=Assistant::all();
}
elseif(is_numeric($request->key)){
  $result=Assistant::where('id','LIKE','%'.$request->key.'%')->get();
}
elseif(is_string($request->key)){
   $result=Assistant::where('englishName','LIKE','%'.$request->key.'%')->get();
}

foreach ($result as $obj) {
$output.='<tr><td>'.$obj->englishName.'</td>
                <td>'.$obj->email.'</td>
                <td>'.$obj->salary.'</td>
                <td>'.$obj->department->name.'</td>
                <td><img src="'.asset('storage/'.$obj->profilePicture).'" width="100" height="70" alt="-"></td>
                <td>
                <a href="'.url('assistants/update/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                  <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getsecid('.$obj->id.')"><i class="fa fa-address-book" aria-hidden="true"></i> Assign</button>'.'
   <a href="'.url('assistants/delete/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure To Delete This Assistant')".'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td></tr>';    

}


}




return response()->json($output);

}

public function tableorderBy(Request $request){
  $output='';
if($request->type=='student'){
  $v=Validator::make($request->all(),['column'=>['required','string',Rule::in(['englishName','id', 'email','level','mainDepartmentId','username']),
]]);

if($v->fails()){
  return response()->json(['reply' =>$v->errors()->all()]);
}
$students=Student::orderBy($request->column,'ASC')->get();
foreach ($students as $obj) {
$output.='<tr><td>'.$obj->id.'</td>
                  <td>'.$obj->englishName.'</td>
                   <td>'.$obj->email.'</td>
                  <td>'.$obj->level.'</td>
                  <td>'.$obj->username.'</td>
                  <td>'.$obj->department->name.'</td>
                  <td><img src="'.asset('storage/'.$obj->profilePicture).'" width="100" height="70" alt="-"></td>
          <td>
          <a href="'.url('admin/students/update/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>';
  $output.= ' 
  <a href="'.url('admin/students/delete/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure To Delete?')".'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></td></tr>';           
}

}
elseif ($request->type=="course") {
$v=Validator::make($request->all(),['column'=>['required','string',Rule::in(['englishName', 'courseCode','available','hours','category','prerequisiteCourseId','departmentId']),
]]);

if($v->fails()){
  return response()->json(['reply' =>$v->errors()->all()]);
}

  $orderedCourses=Course::orderBy($request->column,'ASC')->get();
foreach ($orderedCourses as $obj) {
$output.='<tr><td>'.$obj->englishName.'</td><td>'
         .$obj->courseCode.'</td><td>'
         .$obj->hours.'</td><td>'
         .$obj->department->symbol.'</td><td>'
         .$obj->available.'</td><td>';
         if($obj->category)
          $output.='Mandatory</td>';
        else
          $output.='Optional</td>';

         if(isset($obj->prerequisiteCourse))
           $output.= '<td>'.$obj->prerequisiteCourse->courseCode.'</td>';
          else  $output.='<td></td>';  

$output.= '<td><a href="'.url('/admin/updatecourse/'.$obj->id).'" class="btn btn-primary" ><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>'
          .' <a href="'.url('/admin/showEvaluations/'.$obj->id).'" class="btn btn-primary" ><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Evaluations</a>';
         
          if($obj->available){
            $output.=' <a href="'.url('/admin/showcoursestudents/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Students</a>';}
            
            $output.= ' <a href="'.url('/admin/courses/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure To Delete This Course')".'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';  
 

}

}

elseif($request->type=='professor'){
   $v=Validator::make($request->all(),['column'=>['required','string',Rule::in(['englishName', 'email','salary','mainDepartmentId']),
]]);

if($v->fails()){
  return response()->json(['reply' =>$v->errors()->all()]);
}
$orderedProfessors=Professor::orderBy($request->column,'ASC')->get();
foreach ($orderedProfessors as $obj) {
$output.='<tr><td>'.$obj->englishName.'</td>
                   <td>'.$obj->email.'</td>
                  <td>'.$obj->salary.'</td>
                  <td>'.$obj->department->name.'</td>
                  <td><img src="'.asset('storage/'.$obj->profilePicture).'" width="100" height="70" alt="-"></td>
<td><a href="'.url('admin/professors/update/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getid('.$obj->id.')"><i class="fa fa-address-book" aria-hidden="true"></i> Assign</button>'.'
  <a href="'.url('admin/professors/delete/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure You Want To Delete')".'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td></tr>';     
}
}

elseif ($request->type=='assistant') {
  $v=Validator::make($request->all(),['column'=>['required','string',Rule::in(['englishName', 'email','salary','mainDepartmentId']),
]]);

if($v->fails()){
  return response()->json(['reply' =>$v->errors()->all()]);
}
$orderedAssistants=Assistant::orderBy($request->column,'ASC')->get();

foreach ($orderedAssistants as $obj) {
$output.='<tr><td>'.$obj->englishName.'</td>
                <td>'.$obj->email.'</td>
                <td>'.$obj->salary.'</td>
                <td>'.$obj->department->name.'</td>
                <td><img src="'.asset('storage/'.$obj->profilePicture).'" width="100" height="70" alt="-"></td>
                <td>
                <a href="'.url('assistants/update/'.$obj->id).'" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                 <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getsecid('.$obj->id.')"><i class="fa fa-address-book" aria-hidden="true"></i> Assign</button>'.'
  <a href="'.url('assistants/delete/'.$obj->id).'" class="btn btn-danger" onclick="return '.
            "confirm('Are You Sure To Delete This Assistant')".'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td></tr>';    

}


}
return response()->json($output);
}

public function setting(Request $request){
  if($request->isMethod('post')){

    if($request->has('1')) Setting::where('id',1)->update(['status'=>1]);
    else Setting::where('id',1)->update(['status'=>0]);

    if($request->has('2')) Setting::where('id',2)->update(['status'=>1]);
    else Setting::where('id',2)->update(['status'=>0]);

    if($request->has('3')) Setting::where('id',3)->update(['status'=>1]);
    else Setting::where('id',3)->update(['status'=>0]);

    if($request->has('4')) Setting::where('id',4)->update(['status'=>1]);
    else Setting::where('id',4)->update(['status'=>0]);

    if($request->has('5')) Setting::where('id',5)->update(['status'=>1]);
    else Setting::where('id',5)->update(['status'=>0]);

    if($request->has('6')) Setting::where('id',6)->update(['status'=>1]);
    else Setting::where('id',6)->update(['status'=>0]);

    return redirect('/admin/setting')->with(['message'=>'Setting Has Been Changed Successfully']);

  }else {
    $settings=Setting::all();
    return view('admin.setting',compact('settings'));
  }
}

public function updatenotficationnumbers(){
  auth('admin')->user()->updatenotficationnumbers();
}

}