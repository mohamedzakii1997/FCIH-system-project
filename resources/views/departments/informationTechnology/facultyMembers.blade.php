@extends('layouts.frontend')
@section('title')
	Information Technology - Faculty Members
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<nav aria-label="breadcrumb" class="breadcrumb-container">
		  <ol class="breadcrumb" style="background-color: transparent">
		    <li class="breadcrumb-item"><a href="{{url('/departments/overview')}}">Departments</a></li>
		    <li class="breadcrumb-item"><a href="{{url('/departments/informationTechnology/word')}}">Information Technology</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Faculty Members</li>
		  </ol>
		</nav>
		<h1 style="font-size: 30px;margin-bottom: 80px;font-weight: bold">Faculty Members Of Information Technology</h1>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Professors List</h2>
		<ul>
			<li>Dr. Hossam Shamardan	Assistant Professor</li>		
			<li>Dr. Maged Wafi	Assistant Professor</li>		
			<li>Dr. Mahmoud Elkholy	Associate Professor (Vice dean Student Affairs) </li>		
			<li>Dr. Nahla Elnagar	Assistant Professor</li>		
			<li>Dr. Taha Mahdy	Assistant Professor</li>		
			<li>Dr. Yasser Hifny	Assistant Professor</li>
		</ul>
	</div>
@endsection