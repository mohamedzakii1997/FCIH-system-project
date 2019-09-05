@extends('layouts.frontend')
@section('title')
	Exceptional Request
@endsection
@section('extraStyle')
	.form-group{
	margin-bottom:20px

}
@endsection

@section('content')
        <div class="col-lg-6" style="margin: 0 auto;margin-top: 10px;">
             <div class="card">
                <div class="card-header d-flex align-items-center">
                <h3 class="h4">Exceptional Request</h3>
                   </div>
                 <div class="card-body">
                	<form class="form-horizontal" method="post" action="{{url('student/sendExceptionalRequest')}}">
                         {{ csrf_field() }}
                    <div class="form-group row">
	                    <label class="col-sm-3 form-control-label">Course</label>
	                    <div class="col-sm-9">
	                        <select class="form-control" name="courseId" required>
	                        	@foreach($openCourses as $course)
	                        		<option value="{{$course->id}}">{{$course->courseCode}} | {{$course->englishName}} | {{$course->arabicName}}</option>
	                        	@endforeach
	                        </select>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label class="col-sm-3 form-control-label">Reason</label>
	                    <div class="col-sm-9">
	                        <select class="form-control" name="reason" required>
	                        	<option value="Needed To Finish My Last Semester">Needed To Finish My Last Semester</option>
	                        	<option value="Needed to Register a Department Next Semester">Needed to Register a Department Next Semester</option>
	                        	<option value="My GPA More Than 3.4">My GPA More Than 3.4</option>
	                        </select>
	                    </div>
	                </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Message (Optional)</label>
                        <div class="col-sm-9">
                        	<textarea name="message" class="form-control" style="height: 150px" ></textarea>
                        </div>
                    </div>
                    <input type="submit" name="save" value="save" class="btn btn-primary" >
                    </form>
                </div>
            </div>
        </div>
@endsection