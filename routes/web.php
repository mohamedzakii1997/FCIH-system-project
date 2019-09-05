<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','HomeController@index');
Route::get('/download/college/list','HomeController@download');
Route::view('/researchplan','researchplan');
Route::view('/informationsecuritylab','informationSecurityLab');
Route::view('/login','loginPage')->middleware('guest');
Route::get('/home','HomeController@index')->name('home');
Route::post('/login','Auth\LoginController@customLogin')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::prefix('/articles')->group(function(){
	Route::get('/all','mainController@getArticles');
	Route::get('/{id}','mainController@getArticle');
	Route::get('/delete/{id}','adminController@deleteArticle');
	Route::match(['get','post'],'/add','professorController@addArticle');
	Route::match(['get','post'],'/update/{id}','professorController@updateArticle');
});
Route::prefix('/departments')->group(function(){
    Route::view('/overview','departments/overview');
    Route::prefix('/computerScience')->group(function(){
        Route::view('/word','departments/computerScience/word');
        Route::view('/facultyMembers','departments/computerScience/facultyMembers');
        Route::view('/courses','departments/computerScience/courses');
        Route::view('/programmeSpecification','departments/computerScience/programmeSpecification');
    });
    Route::prefix('/informationSystem')->group(function(){
        Route::view('/word','departments/informationSystem/word');
        Route::view('/facultyMembers','departments/informationSystem/facultyMembers');
        Route::view('/courses','departments/informationSystem/courses');
        Route::view('/programmeSpecification','departments/informationSystem/programmeSpecification');
    });
    Route::prefix('/informationTechnology')->group(function(){
        Route::view('/word','departments/informationTechnology/word');
        Route::view('/facultyMembers','departments/informationTechnology/facultyMembers');
        Route::view('/courses','departments/informationTechnology/courses');
        Route::view('/programmeSpecification','departments/informationTechnology/programmeSpecification');
    });
});
Route::prefix('/assistants')->group(function(){
    Route::get('/all','adminController@getassistants');
    Route::get('/delete/{id}','adminController@deleteAssistant');
    Route::match(['get','post'],'/add','adminController@addAssistant');
    Route::match(['get','post'],'/update/{id}','adminController@updateAssistant');
    Route::get('/getids','adminController@getassistantsCoursesIds');
    Route::post('/assign','adminController@assignassistant');
    Route::get('/showcourses','adminController@showassistant_courses');
    Route::get('/deleteassign/{id}/{c_id}','adminController@deleteAssistantassign');
    Route::match(['get','post'],'/notify','adminController@notifyAsisstants');
});

Route::prefix('/sections')->group(function() {
    Route::get('/all', 'adminController@getsections');
    Route::match(['get','post'],'/add','adminController@addSection');
    Route::match(['get','post'],'/update/{id}','adminController@updateSection');
    Route::get('/delete/{id}','adminController@deleteSection');
}); 

Route::prefix('/admin')->group(function(){
    Route::match(['get','post'],'/setting','adminController@setting');
    Route::match(['get','post'],'/editprofile','adminController@editProfile');
    Route::match(['get','post'],'/editpassword','adminController@changePassword');
    Route::get('/dashboard','adminController@dashboard');
    Route::get('/exceptionalRequests','adminController@showExceptionalRequests');
    Route::get('/exceptionalRequests/{id}','adminController@answerExceptionalRequest');
	Route::match(['get','post'],'/addcourse','adminController@addcourse');
	Route::match(['get','post'],'/addDepartment','adminController@addDepartment');
	Route::match(['get','post'],'/updatecourse/{id}','adminController@updatecourse');
	Route::match(['get','post'],'/updateDepartment/{id}','adminController@updateDepartment');
    Route::get('showEvaluations/{id}','adminController@showEvaluations');
	Route::get('/courses','adminController@showcourses');
	Route::get('/departments','adminController@showdepartments');
	Route::get('/courses/{id}','adminController@deletecourse');
	Route::get('/departments/{id}','adminController@deleteDepartment');
    Route::get('/showoveralltable','adminController@showOverAllTable');
    Route::get('/showoverallsections','adminController@showOverallSections');
    Route::get('/showcoursestudents/{id}','adminController@showAvailableCourseStudents');
    Route::post('/assignstudentfinal','adminController@assignStudentFinal');
    Route::get('/supportterm','adminController@supportTerm');
    Route::get('/search','adminController@search');
    Route::get('/order','adminController@tableorderBy');
    Route::get('/updatemynotific','adminController@updatenotficationnumbers');
	Route::prefix('/students')->group(function(){
        Route::get('/all', 'adminController@showAllStudent');
        Route::match(['get','post'],'/add','adminController@addStudent');
        Route::match(['get','post'],'/update/{id}','adminController@updateStudent');   
        Route::get('/delete/{id}','adminController@deleteStudent');
        Route::match(['get','post'],'/notify','adminController@notifyStudents');
    }
    );
    Route::prefix('/professors')->group(function(){
        Route::get('/all', 'adminController@showAllProfessors');
        Route::match(['get','post'],'/add','adminController@addProfessor');
        Route::match(['get','post'],'/update/{id}','adminController@updateProfessor');   
        Route::get('/delete/{id}','adminController@deleteProfessor');
        Route::get('/getids', 'adminController@getCoursesIds');
        Route::post('/assign','adminController@assignProf');
        Route::get('/showprofs','adminController@showProfs_Courses');
        Route::get('/deleteassign/{id}/{c_id}','adminController@deleteassign');
        Route::match(['get','post'],'/notify','adminController@notifyProfs');
    }
    );
    Route::prefix('/lectures')->group(function(){
        Route::get('/all', 'adminController@showAllLecture');
        Route::match(['get','post'],'/add','adminController@addLecture');
        Route::match(['get','post'],'/update/{id}','adminController@updateLecture');
        Route::get('/delete/{id}','adminController@deleteLecture');
    }); 

});
Route::prefix('/student')->group(function(){
    Route::match(['get','post'],'/editprofile','studentController@editProfile');
    Route::match(['get','post'],'/editpassword','studentController@changePassword');
    Route::match(['get','post'],'/registerDepartment','studentController@registerDepartment');
    Route::get('/showCourses','studentController@showCourses');
    Route::get('/getnotifications', 'studentController@getmynotification');
    Route::get('/updatemynotification', 'studentController@updateNotificationNumbers');
    Route::get('/account','studentController@account');
    Route::get('/showregister','studentController@showregister');
    Route::get('/register/{id}','studentController@register');
    Route::get('/unregister/{id}','studentController@unregister');
    Route::get('/showExceptionalRequests','studentController@showExceptionalRequests');
    Route::post('/sendExceptionalRequest','studentController@sendExceptionalRequest');
    Route::get('/showoveralltable','studentController@showoverAllTable');
    Route::get('/showmytable','studentController@showmytable');
    Route::get('/showoverallsections','studentController@showoverAllSections');
    Route::post('/evaluate','studentController@evaluate');
    Route::get('/transcript','studentController@showTranscipt');
    Route::get('/coursefiles','studentController@showmyCourseResources');
    Route::get('/downloadfile','studentController@downloadFile');
});
 Route::prefix('/professor')->group(function(){
    Route::match(['get','post'],'/editprofile','professorController@editProfile');
    Route::match(['get','post'],'/editpassword','professorController@changePassword');
    Route::get('/getnotifications', 'professorController@getmynotification');
    Route::get('/updatemynotification', 'professorController@updateNotificationNumbers');
    Route::get('/files','professorController@showfiles');
    Route::get('/deletefiles','professorController@deletefile');
    Route::get('/all', 'professorController@showAllcourse');
    Route::get('/students/{id}', 'professorController@showstudent');
    Route::post('/assigngrade', 'professorController@assignStudentGrade');
    Route::post('/upload', 'professorController@uploadfile');
    Route::get('/showmycourses', 'professorController@showmytable');
 });

 Route::prefix('/assistant')->group(function(){
    Route::match(['get','post'],'/editprofile','assistantController@editProfile');
    Route::match(['get','post'],'/editpassword','assistantController@changePassword');
    Route::get('/getnotifications', 'assistantController@getmynotification');
    Route::get('/updatemynotification', 'assistantController@updateNotificationNumbers');
    Route::get('/files','assistantController@showfiles');
    Route::get('/deletefiles','assistantController@deletefile');
    Route::get('/all', 'assistantController@showAllcourse');
    Route::get('/students/{id}', 'assistantController@showstudent');
    Route::post('/assigngrade', 'assistantController@assignStudentGrade');
    Route::post('/upload', 'assistantController@uploadfile'); 
    Route::get('/showmysections', 'assistantController@showmytable');   
 });