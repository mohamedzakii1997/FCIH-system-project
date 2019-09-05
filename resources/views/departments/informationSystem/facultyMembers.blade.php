@extends('layouts.frontend')
@section('title')
	Information System - Faculty Members
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<nav aria-label="breadcrumb" class="breadcrumb-container">
		  <ol class="breadcrumb" style="background-color: transparent">
		    <li class="breadcrumb-item"><a href="{{url('/departments/overview')}}">Departments</a></li>
		    <li class="breadcrumb-item"><a href="{{url('/departments/informationSystem/word')}}">Information System</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Faculty Members</li>
		  </ol>
		</nav>
		<h1 style="font-size: 30px;margin-bottom: 80px;font-weight: bold">Faculty Members Of Information System</h1>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Professors List</h2>
		<ul>
			<li>Dr. Ahmed Bahaa	Assistant Professor</li>		
			<li>Dr. Amany Abdo	Assistant Professor</li>		
			<li>Dr. Chaymaa Salama	Assistant Professor</li>		
			<li>Dr. Layla AbdelLatif	Assistant Professor</li>		
			<li>Dr. Maha Atia	Associate Professor</li>		
			<li>Dr. Mahmoud AbdelLaif	Assistant Professor</li>		
			<li>Dr. Mahmoud Mostafa	Assistant Professor</li>		
			<li>Dr. Manal Abd El Kader	Assistant Professor		</li>
			<li>Dr. Marwa Salah	Assistant Professor</li>		
			<li>Dr. Mohamed Maaray	Assistant Professor</li>		
			<li>Dr. Mona Nasr	Associate Professor</li>		
			<li>Dr. Sherif Kholif	Assistant Professor</li>		
			<li>Dr. Usama Emam	Assistant Professor</li>		
			<li>Prof. Ahmed Sharaf Eldin Ahmed</li>			
			<li>Prof. Hawaf Abdelhakim	Professor of Information Systems</li>		
			<li>Prof. Layla Elfangary</li>
		</ul>
	</div>
@endsection