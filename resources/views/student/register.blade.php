@extends('layouts.frontend')

@section('title')
	Registrations
@endsection
@section('content')
<div class="container">
		<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>اسم</th>
				    <th>Department</th>
				    <th scope="col">Hours</th>
				    <th>Option</th>
			    </tr>
			 </thead>
			 <tbody>
			 	@foreach($openCourses as $course)
			 		<tr>
			 			<td>{{$course->courseCode}}</td>
			 			<td>{{$course->englishName}}</td>
			 			<td>{{$course->arabicName}}</td>
			 			<td>{{$course->department->symbol}}</td>
			 			<td>{{$course->hours}}</td>
			 			<td>
			 				@if($registrations->contains($course->id))
			 					<a class="btn btn-danger" href="{{url('student/unregister/'.$course->id)}}"><i class="fa fa-times" aria-hidden="true"></i> Remove</a>
			 				@else
			 					<a class="btn btn-primary" href="{{url('student/register/'.$course->id)}}"><i class="fa fa-registered" aria-hidden="true"></i> Register</a>
			 				@endif

			 			</td>
			 		</tr>
				@endforeach
			 </tbody>
		</table>
	</div>

@endsection
