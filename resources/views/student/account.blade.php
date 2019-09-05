@extends('layouts.frontend')
@section('title')
	My Account
@endsection

@section('extraStyle')
		.account{
			display: block;
			width: 49%;
			float: left;
			height:450px;
			background-color:#060606;
			border:1px solid #747d8c;
			margin: 15px 1% 15px 0;
			transition: background-color 1s ease-in-out 0s;
			color:#fff

		}
		.account:hover{
		background-color:#060606d6;
		color:#fff
	}
	.account span{
	display:block;
	text-align:center
}
.account div{
	height:400px;
	text-align:center;
	font-size:250px
}
	
@endsection
@section('content')
<div class="container">
	<a href="{{url('student/showregister')}}"  class="account"><div><i class="fa fa-registered" aria-hidden="true"></i></div> <span>Register Courses</span></a>
	<a href="{{url('student/showExceptionalRequests')}}" class="account"><div><i class="fa fa-tachometer" aria-hidden="true"></i></div> <span>Exceptional Request</span></a>
	<a href="{{url('student/showCourses')}}" class="account"><div><i class="fa fa-address-book" aria-hidden="true"></i></div><span>My Courses</span></a>
	<a href="{{url('student/showmytable')}} " class="account"><div><i class="fa fa-suitcase" aria-hidden="true"></i></div><span>My Table</span></a>
	<a href="{{url('student/showoveralltable')}} " class="account"><div><i class="fa fa-table" aria-hidden="true"></i></div><span>OverAll Lectures Table</span></a>
	<a href="{{url('student/showoverallsections')}} " class="account"><div><i class="fa fa-table" aria-hidden="true"></i></div><span>OverAll Section Table</span></a>
	<a href="{{url('student/registerDepartment')}} " class="account"><div><i class="fa fa-university" aria-hidden="true"></i></div><span>Register Department</span></a>
	<a href="{{url('student/transcript')}} " class="account"><div><i class="fa fa-address-card" aria-hidden="true"></i></div><span>My Transcript</span></a>
</div>
@endsection
