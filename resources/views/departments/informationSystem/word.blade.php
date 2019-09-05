@extends('layouts.frontend')
@section('title')
	Information System
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<nav aria-label="breadcrumb" class="breadcrumb-container">
		  <ol class="breadcrumb" style="background-color: transparent">
		    <li class="breadcrumb-item"><a href="{{url('/departments/overview')}}">Departments</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Information System</li>
		  </ol>
		</nav>
		<h1 style="font-size: 30px;margin-bottom: 20px;font-weight: bold">Information System</h1>
		<ul class="deplist">
			<li><a href="{{url('departments/informationSystem/programmeSpecification')}}" >Programme Specifications</a></li>
			<li><a href="{{url('departments/informationSystem/facultyMembers')}}" >Faculty Members</a></li>
			<li><a href="{{url('departments/informationSystem/courses')}}">Courses</a></li>
		</ul>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Head of the Department of Information System</h2>
		<p>
A. D. Ahmed Sharaf al-Din Ahmed Professor, Department of Computer Science and the supervisor of the department
		</p>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">See department</h2>
		<p>
			Emanate see section to see the college , which is to contribute to the development of the educational process and provide a model for specialized programs as a nucleus for the development of academic programs other college in addition to the active participation of faculty in the development of the local environment through development programs applied distinct , which works on the development of Helwan area and surrounding industrial areas 
		</p>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Message Department</h2>
		<p>
			Emanate message section of the mission of the College , which are summarized in the provision of educational services and distinguished research students keep pace with the quality standards of local and global in the fields of computer science , allowing the preparation of a distinguished graduate competitive in addition to the completion of scientific research upscale and active participation in community service and the surrounding environment Objectives.
		</p>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Emanate goals section of the objectives of the College as follows:</h2>
		<ol>
			<li>The preparation of a distinguished graduate in the fields of computer science and programming and software engineering is able to compete in local labor markets , regional and global .</li>
			<li>Continuous improvement in academic programs and educational systems and research in line with the requirements of preparing a distinguished graduate competitive .</li>
			<li>Achieve excellence through studies and scientific and applied research in the areas of specialization.</li>
			<li>Service sector, the government and public business sector and civil society by organizing consulting and technical assistance to them and training the human resources capable of meeting the needs of these sectors in the areas of computer science and technology networks and the Internet.</li>
		</ol>
	</div>
@endsection