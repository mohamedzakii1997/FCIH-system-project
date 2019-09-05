<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Department;
use App\Professor;
use App\Lecutre;
use App\Studnet;
use Illuminate\Support\Facades\DB;
use App\Notifications\PuchNotification;
use Notification;
use Illuminate\Notifications\Notifiable;
class Admin extends User
{
    use Notifiable;
    public $timestamps = false;

    public function deleteArticle($artice){
    	$artice->delete();
    }
    public function deleteStudent($student){
         $student->delete();
    }

    public function deletecourse($id)
    {
        $course=Course::findOrFail($id);
        if($course->category){
          $department=$course->department;
          $department->mandatory-=$course->hours;
          $department->save();
        }
		    $course->delete();
    }
    public function showCourses(){
        return Course::all();
    }
    public function showdepartments(){
        return Department::all();
    }

    public function addcourse($englishname,$arabicname,$departmentid,$hours,
    $finalgrade,$totalgrade,$precourseid,$coursecode,$available,$midtermGrade,$category)
    {
        $course=new Course();
        $course->englishName=$englishname;
        $course->arabicName=$arabicname;
        $course->departmentId=$departmentid;
        $course->hours=$hours;
        $course->finalGrade=$finalgrade;
        $course->totalGrade=$totalgrade;
        $course->prerequisiteCourseId=$precourseid;
        $course->courseCode=$coursecode;
        $course->available=$available;
        $course->midtermGrade=$midtermGrade;
        $course->category=$category;
        $course->save();
        if($course->category){
          $department=$course->department;
          $department->mandatory+=$course->hours;
          $department->save();
        }

    }

    public function addDepartment($name,$symbol,$optional)
    {
        $department=new Department();
        $department->name=$name;
        $department->symbol=$symbol;
        $department->optional=$optional;
        $department->save();
    }


    public function updateDepartment($department,$name,$symbol,$optional)
    {
        $department->name=$name;
        $department->symbol=$symbol;
        $department->optional=$optional;
        $department->save();
    }

    public function deleteDepartment($id)
    {
        $department=Department::findOrFail($id);
		$department->delete();
    }

    public function updatecourse($course,$englishname,$arabicname,$departmentid,$hours,
    $finalgrade,$totalgrade,$precourseid,$coursecode,$available,$midtermGrade,$category)
    {
        if($course->departmentId==$departmentid&&$course->category==$category&&$category){
          $department=$course->department;
          $department->mandatory-=$course->hours;
          $department->mandatory+=$hours;
          $department->save();

        }elseif($course->departmentId==$departmentid&&$course->category!=$category&&!$category){
          $department=$course->department;
          $department->mandatory-=$course->hours;
          $department->save();

        }elseif($course->departmentId==$departmentid&&$course->category!=$category&&$category){
          $department=$course->department;
          $department->mandatory+=$hours;
          $department->save();

        }elseif($course->departmentId!=$departmentid&&$course->category==$category&&$category){
          $department=$course->department;
          $department->mandatory-=$course->hours;
          $newDepartment=Department::findOrFail($departmentid);
          $newDepartment->mandatory+=$hours;
          $department->save();
          $newDepartment->save();
        }elseif($course->departmentId!=$departmentid&&$course->category!=$category&&$category){
          $newDepartment=Department::findOrFail($departmentid);
          $newDepartment->mandatory+=$hours;
          $newDepartment->save();

        }elseif($course->departmentId!=$departmentid&&$course->category!=$category&&!$category){
          $department=$course->department;
          $department->mandatory-=$course->hours;
          $department->save();

        }
        $course->englishName=$englishname;
        $course->arabicName=$arabicname;
        $course->departmentId=$departmentid;
        $course->hours=$hours;
        $course->finalGrade=$finalgrade;
        $course->totalGrade=$totalgrade;
        $course->prerequisiteCourseId=$precourseid;
        $course->courseCode=$coursecode;
        $course->available=$available;
        $course->midtermGrade=$midtermGrade;
        $course->category=$category;
        $course->save();
    }

     public function updateProfessor($prof,$validdata){
         $prof->englishName=$validdata['englishName'];
       $prof->arabicName=$validdata['arabicName'];
       $prof->username=$validdata['username'];
       if (!empty($validdata['password'])) {
       $prof->password=bcrypt($validdata['password']);      
       }
       $prof->email=$validdata['email'];
       $prof->SSN=$validdata['SSN'];
       $prof->gender=$validdata['gender'];
       $prof->salary=$validdata['salary'];
       $prof->salary=$validdata['mainDepartmentId'];
       $prof->save();
    }

     public function deleteProfessor($prof){
      $prof->delete();
    }
    public function assignProf($c_id,$prof_id){
      DB::table('course_professor')->insert(
    ['courseId' => $c_id, 'professorId' => $prof_id]
);
    }
    public function editassign($prof_c,$data){

  DB::table('course_professor')
            ->where([['courseId','=',$prof_c[0]->courseId]
,['professorId','=',$prof_c[0]->professorId]
          ])
            ->update(['courseId' =>$data]);

    }
    
    public function deleteassign($id,$c_id){
      DB::table('course_professor')->where([['courseId','=',$c_id],['professorId','=',$id]])->delete();
    }

    public function updateLecture($lec,$data){
      $lec->professorId=$data['professorId'];
      $lec->courseId=$data['courseId'];
      $lec->location=$data['location'];
      $lec->duration=$data['duration'];
      $lec->time=$data['time'];
      $lec->day=$data['day'];
      $lec->save();
    }
    public function deleteLecture($lec){
         $lec->delete();
    }
    public function addStudent($data){
      $student=new Student();
      $student->englishName=$data['englishName'];
      $student->arabicName=$data['arabicName'];
      $student->gender=$data['gender'];
      $student->username=$data['username'];
      $student->password=$data['password'];
      $student->email=$data['email'];
      $student->SSN=$data['SSN'];
      $student->mainDepartmentId=$data['mainDepartmentId'];
      $student->save();
    }
    public function updateStudent($student,$validdata){
      $student->englishName=$validdata['englishName'];
       $student->arabicName=$validdata['arabicName'];
       $student->username=$validdata['username'];
       if (!empty($validdata['password'])) {
       $student->password=bcrypt($validdata['password']);      
       }
       $student->email=$validdata['email'];
       $student->SSN=$validdata['SSN'];
       $student->gender=$validdata['gender'];
       $student->save();
    }
    public function addProfessor($data){
      $professor=new Professor();
      $professor->englishName=$data['englishName'];
      $professor->arabicName=$data['arabicName'];
      $professor->gender=$data['gender'];
      $professor->username=$data['username'];
      $professor->password=$data['password'];
      $professor->email=$data['email'];
      $professor->SSN=$data['SSN'];
      $professor->mainDepartmentId=$data['mainDepartmentId'];
      $professor->salary=$data['salary'];
      $professor->save();
    }
   public function addLecture($data){
      $lec=new Lecture();
      $lec->courseId=$data['courseId'];
      $lec->professorId=$data['professorId'];
      $lec->location=$data['location'];
      $lec->duration=$data['duration'];
      $lec->time=$data['time'];
      $lec->day=$data['day'];
      $lec->save();
   }

   public  function addAssistant($data){


        $assistant=new Assistant();
      $assistant->englishName=$data['englishName'];
      $assistant->arabicName=$data['arabicName'];
      $assistant->gender=$data['gender'];
      $assistant->username=$data['username'];
      $assistant->password=$data['password'];
      $assistant->email=$data['email'];
      $assistant->SSN=$data['SSN'];
      $assistant->mainDepartmentId=$data['mainDepartmentId'];
      $assistant->salary=$data['salary'];
      $assistant->save();


}




public function addSection($data){

$sec=new Section();
      $sec->courseId=$data['courseId'];
      $sec->assistantId=$data['assistantId'];
      $sec->location=$data['location'];
      $sec->duration=$data['duration'];
      $sec->time=$data['time'];
      $sec->day=$data['day'];
      $sec->save();
}
    public function updateSection($section,$data){
        $section->assistantId=$data['assistantId'];
      $section->courseId=$data['courseId'];
      $section->location=$data['location'];
      $section->duration=$data['duration'];
      $section->time=$data['time'];
      $section->day=$data['day'];
      $section->save();

    }



    public function updateAssistant($assistant,$validdata){
      $assistant->englishName=$validdata['englishName'];
       $assistant->arabicName=$validdata['arabicName'];
       $assistant->username=$validdata['username'];
       if (!empty($validdata['password'])) {
       $assistant->password=bcrypt($validdata['password']);      
       }
       $assistant->email=$validdata['email'];
       $assistant->SSN=$validdata['SSN'];
       $assistant->gender=$validdata['gender'];
       $assistant->salary=$validdata['salary'];
       $assistant->salary=$validdata['mainDepartmentId'];
       $assistant->save();
    }


    public function deleteAssistant($assistant){
        $assistant->delete();
    }



public function deleteSection($section){

        $section->delete();

}

public function assignassistant($id,$c_id){
    DB::table('assistant_course')->insert(
        ['courseId' => $c_id, 'assistantId' => $id]
    );
}

public function updateassisCourses($assis_c,$c_id){

    DB::table('assistant_course')
        ->where([['courseId','=',$assis_c[0]->courseId]
            ,['assistantId','=',$assis_c[0]->assistantId]
        ])
        ->update(['courseId' =>$c_id]);
}

public function deleteAssistantAssign($id,$c_id){
    DB::table('assistant_course')->where([['courseId','=',$c_id],['assistantId','=',$id]])->delete();
}
 public function notifyStudents($data){

    $students=Student::all();
    Notification::send($students, new PuchNotification($data));
 }
 public function notifyProfs($data){
  $profs=Professor::all();
        Notification::send($profs, new PuchNotification($data));
 }
 public function notifyAsisstants($data){
  $assistants=Assistant::all();
        Notification::send($assistants, new PuchNotification($data));
 }

 public function updatenotficationnumbers(){
  foreach (auth('admin')->user()->unreadNotifications as $notification) {
    # code...
    $notification->markAsRead();
  }
 
 }

}
