@extends('layouts.frontend')
@section('title')
	Our Departments
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<nav aria-label="breadcrumb" class="breadcrumb-container">
		  <ol class="breadcrumb" style="background-color: transparent">
{{-- 		    <li class="breadcrumb-item"><a href="#">Home</a></li>
 --}}		    <li class="breadcrumb-item active" aria-current="page">Departments</li>
		  </ol>
		</nav>
		<h1 style="font-size: 30px;margin-bottom: 20px;font-weight: bold">Departments Of Our College</h1>
		<ul class="deplist">
			<li><a href="{{url('departments/computerScience/word')}}" >Computer Science</a></li>
			<li><a href="{{url('departments/informationSystem/word')}}" >Information System</a></li>
			<li><a href="{{url('departments/informationTechnology/word')}}">Information Technology</a></li>
		</ul>
	</div>
@endsection