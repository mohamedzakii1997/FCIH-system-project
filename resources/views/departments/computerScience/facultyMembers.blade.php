@extends('layouts.frontend')
@section('title')
	Computer Science - Faculty Members
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<nav aria-label="breadcrumb" class="breadcrumb-container">
		  <ol class="breadcrumb" style="background-color: transparent">
		    <li class="breadcrumb-item"><a href="{{url('/departments/overview')}}">Departments</a></li>
		    <li class="breadcrumb-item"><a href="{{url('/departments/computerScience/word')}}">Computer Science</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Faculty Members</li>
		  </ol>
		</nav>
		<h1 style="font-size: 30px;margin-bottom: 80px;font-weight: bold">Faculty Members Of Compter Science</h1>
		<h2 style="font-size: 20px;margin:50px 0; font-weight: bold">Professors List</h2>
		<ul>
			<li>Dr. Amal Aboutable	Assistant Professor</li>		
<li>Dr. Aya Sedky			</li>
<li>Dr. Ayman Ezzat	Assistant Professor	</li>	
<li>Dr. Ghada Khoriba	Assistant Professor	</li>	
<li>Dr. Hala Ahmed	Assistant Professor		</li>
<li>Dr. Marwa Abdelfattah	Assistant Professor	</li>	
<li>Dr. Mohamed Belal	Professor of Computer Science (Dean of the faculty)		</li>
<li>Dr. Mohamed Hagag	Associate Professor (Vice dean environmental affairs)</li>		
<li>Dr. Mohammed Nabil Alaggan	</li>		
<li>Dr. Omar Hamdy	Assistant Professor</li>
<li>Dr. Waleed Youssef	Assistant Professor	</li>	
<li>Dr. Wessam Elbehidy	Assistant Professor	</li>	
<li>Prof. Aliaa Youssef	Professor of Computer Science (Vice dean graduate affairs))</li>
<li>Prof. Atef Ghalwash	Professor Emeritus		</li>
<li>Prof. Mostafa Sami	Professor Emeritus - Head department of CS</li>
		</ul>
	</div>
@endsection