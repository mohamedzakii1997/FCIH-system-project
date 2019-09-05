@extends('layouts.frontend')


@section('content')

<div class="container" style="width: 600px;float: left; margin-bottom: 10px;">
<table class="table table-bordered">
			 
			 <tbody>
              <tr>
              	<td style="font-weight: bold;">Student Name</td>
              	<td>{{auth()->user()->englishName}}</td>
              </tr>
              <tr>
              	<td style="font-weight: bold;">اسم الطالب</td>
              	<td>{{auth()->user()->arabicName}}</td>
              </tr>

			 	<tr>
			 		<td style="font-weight: bold;">GPA</td>
			 		<td>{{auth()->user()->GPA}}</td>
			 		</tr>
			 		<tr>
			 		<td style="font-weight: bold;">Rate</td>	
			 		<td>
			 			@if(auth()->user()->GPA<2)
			 			Failed
			 			@elseif(auth()->user()->GPA >= 2 && auth()->user()->GPA < 2.4)
			 			Acceptable
			 			@elseif(auth()->user()->GPA >= 2.4 && auth()->user()->GPA < 2.8)
			 			Good
			 			@elseif(auth()->user()->GPA >=2.8 &&auth()->user()->GPA <3.4)
			 			Very Good
			 			@elseif(auth()->user()->GPA>=3.4 && auth()->user()->GPA <= 4)
			 			Excellence
			 			@endif

			 		</td>
			 	</tr>
			 	<tr>
			 		<td style="font-weight: bold;">Hours</td>
			 		<td>{{auth()->user()->hours}}</td>
			 	</tr>
			 	<tr>
			 		<td style="font-weight: bold;">Level</td>
			 		<td>{{auth()->user()->level}}</td>
			 	</tr>
			 	@if(auth()->user()->mainDepartmentId>2)
			 	<tr>
              	    <td style="font-weight: bold;">Specialization</td>
              	    <td>{{auth()->user()->department->symbol}}</td>
              </tr>
              @endif

			 </tbody>
</table>			 
</div>
<div style="clear: both;"></div>



<div class="container" style="width: 48%;float: left;">
	<h1 style="text-align:center;font-weight: bold;  ">General Requirments</h1>
<div style="border: 1px solid black;margin-bottom: 10px;text-align: center;font-weight: bold; ">{{$general_mandatory+$general_optional}} hours ({{$general_mandatory}} compulsory hours + {{$general_optional}} elective hours)</div>
<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>Hours</th>
				    <th scope="col">Total</th>
				    <th>Rate</th>
			    </tr>
			 </thead>
			 <tbody>
	             <tr><td colspan="5" style="text-align: center;font-weight: bold;"> compulsory subjects {{$general_mandatory}} hours</td></tr>
	             @php $flag=false; @endphp
	            @foreach($allCourses as $course)
	            	@foreach($myresults as $result)
	            		@if($result->course_id==$course->id&&$course->departmentId==1&&$course->category)
	            			@php $flag=true; @endphp
	            			<tr>
	            				<td>{{$course->courseCode}}</td>
	            				<td>{{$course->englishName}}</td>
	            				<td>{{$course->hours}}</td>
	            				<td>{{$result->grade}}</td>
	            				<td>{{$result->rate}}</td>
	            			</tr>
	            		@endif
	            	@endforeach
	            	@if($flag)
	            		@php $flag=false; @endphp
					@elseif($course->departmentId==1&&$course->category)
            			<tr>
            				<td>{{$course->courseCode}}</td>
            				<td>{{$course->englishName}}</td>
            				<td>{{$course->hours}}</td>
            				<td></td>
            				<td></td>
            			</tr>
            		@endif
	            @endforeach 
			 </tbody>	
</table>

 <table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>Hours</th>
				    <th scope="col">Total</th>
				    <th>Rate</th>
			    </tr>
			 </thead>
			 <tbody>
			 	<tr><td colspan="5" style="text-align: center; font-weight: bold;height:7px; "> elective subjects {{$general_optional}} hours</td></tr>
			 
              @foreach($allCourses as $course)
	            	@foreach($myresults as $result)
	            		@if($result->course_id==$course->id&&$course->departmentId==1&&!$course->category)
	            			@php $flag=true; @endphp
	            			<tr>
	            				<td>{{$course->courseCode}}</td>
	            				<td>{{$course->englishName}}</td>
	            				<td>{{$course->hours}}</td>
	            				<td>{{$result->grade}}</td>
	            				<td>{{$result->rate}}</td>
	            			</tr>
	            		@endif
	            	@endforeach
	            	@if($flag)
	            		@php $flag=false; @endphp
					@elseif($course->departmentId==1&&!$course->category)
            			<tr>
            				<td>{{$course->courseCode}}</td>
            				<td>{{$course->englishName}}</td>
            				<td>{{$course->hours}}</td>
            				<td></td>
            				<td></td>
            			</tr>
            		@endif
	            @endforeach 


			 </tbody>	
</table>

@if(auth()->user()->mainDepartmentId>2)
<h1 style="text-align:center;font-weight: bold;">Specialization Requirments</h1>
	<div style="border: 1px solid black;margin-bottom: 10px; text-align: center;font-weight: bold;">{{$spec_optional+$spec_mandatory}} hours ({{$spec_mandatory}} compulsory hours + {{$spec_optional}} elective hours)</div>
<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>Hours</th>
				    <th scope="col">Total</th>
				     <th>Rate</th>
			    </tr>
			 </thead>
            <tr><td colspan="5" style="text-align: center; font-weight: bold;height:7px; "> compulsory subjects {{$spec_mandatory}} hours</td> </tr>
			 
			  @foreach($allCourses as $course)
	            	@foreach($myresults as $result)
	            		@if($result->course_id==$course->id&&$course->departmentId==auth()->user()->mainDepartmentId&&$course->category)
	            			@php $flag=true; @endphp
	            			<tr>
	            				<td>{{$course->courseCode}}</td>
	            				<td>{{$course->englishName}}</td>
	            				<td>{{$course->hours}}</td>
	            				<td>{{$result->grade}}</td>
	            				<td>{{$result->rate}}</td>
	            			</tr>
	            		@endif
	            	@endforeach
	            	@if($flag)
	            		@php $flag=false; @endphp
					@elseif($course->departmentId==auth()->user()->mainDepartmentId&&$course->category)
            			<tr>
            				<td>{{$course->courseCode}}</td>
            				<td>{{$course->englishName}}</td>
            				<td>{{$course->hours}}</td>
            				<td></td>
            				<td></td>
            			</tr>
            		@endif
	            @endforeach 

			 <tbody>
			 </tbody>	
</table>

<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>Hours</th>
				    <th scope="col">Total</th>
				     <th>Rate</th>
			    </tr>
			 </thead>
			 <tbody>
			 <tr><td colspan="5" style="text-align: center; font-weight: bold;height:7px; "> elective subjects {{$spec_optional}} hours</td></tr>
			 @foreach($allCourses as $course)
	            	@foreach($myresults as $result)
	            		@if($result->course_id==$course->id&&$course->departmentId==auth()->user()->mainDepartmentId&&!$course->category)
	            			@php $flag=true; @endphp
	            			<tr>
	            				<td>{{$course->courseCode}}</td>
	            				<td>{{$course->englishName}}</td>
	            				<td>{{$course->hours}}</td>
	            				<td>{{$result->grade}}</td>
	            				<td>{{$result->rate}}</td>
	            			</tr>
	            		@endif
	            	@endforeach
	            	@if($flag)
	            		@php $flag=false; @endphp
					@elseif($course->departmentId==auth()->user()->mainDepartmentId&&!$course->category)
            			<tr>
            				<td>{{$course->courseCode}}</td>
            				<td>{{$course->englishName}}</td>
            				<td>{{$course->hours}}</td>
            				<td></td>
            				<td></td>
            			</tr>
            		@endif
	            @endforeach 


			 </tbody>	
</table>

@endif

	</div>	


<div class="container" style="width: 49%;float: right;">
	<h1 style="text-align:center;font-weight: bold;">Faculty Requirments</h1>
	<div style="border: 1px solid black;margin-bottom: 14px; text-align: center;font-weight: bold;">{{$uni_mandatory+$uni_optional}} hours ({{$uni_mandatory}} compulsory hours + {{$uni_optional}} elective hours)</div>
<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>Hours</th>
				    <th scope="col">Total</th>
				     <th>Rate</th>
			    </tr>
			 </thead>
			 <tbody>
			 <tr><td colspan="5" style="text-align: center;font-weight: bold;"> compulsory subjects {{$uni_mandatory}} hours</td></tr>
              @foreach($allCourses as $course)
	            	@foreach($myresults as $result)
	            		@if($result->course_id==$course->id&&$course->departmentId==2&&$course->category)
	            			@php $flag=true; @endphp
	            			<tr>
	            				<td>{{$course->courseCode}}</td>
	            				<td>{{$course->englishName}}</td>
	            				<td>{{$course->hours}}</td>
	            				<td>{{$result->grade}}</td>
	            				<td>{{$result->rate}}</td>
	            			</tr>
	            		@endif
	            	@endforeach
	            	@if($flag)
	            		@php $flag=false; @endphp
					@elseif($course->departmentId==2&&$course->category)
            			<tr>
            				<td>{{$course->courseCode}}</td>
            				<td>{{$course->englishName}}</td>
            				<td>{{$course->hours}}</td>
            				<td></td>
            				<td></td>
            			</tr>
            		@endif
	            @endforeach 

			 </tbody>	
</table>

<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>Hours</th>
				    <th scope="col">Total</th>
				    <th>Rate</th>
			    </tr>
			 </thead>
			 <tbody>
			 	<tr><td colspan="5" style="text-align: center;font-weight: bold;"> elective subjects {{$uni_optional}} hours</td></tr>
		     
             @foreach($allCourses as $course)
	            	@foreach($myresults as $result)
	            		@if($result->course_id==$course->id&&$course->departmentId==2&&!$course->category)
	            			@php $flag=true; @endphp
	            			<tr>
	            				<td>{{$course->courseCode}}</td>
	            				<td>{{$course->englishName}}</td>
	            				<td>{{$course->hours}}</td>
	            				<td>{{$result->grade}}</td>
	            				<td>{{$result->rate}}</td>
	            			</tr>
	            		@endif
	            	@endforeach
	            	@if($flag)
	            		@php $flag=false; @endphp
					@elseif($course->departmentId==2&&!$course->category)
            			<tr>
            				<td>{{$course->courseCode}}</td>
            				<td>{{$course->englishName}}</td>
            				<td>{{$course->hours}}</td>
            				<td></td>
            				<td></td>
            			</tr>
            		@endif
	            @endforeach 



			 </tbody>	
</table>





	</div>	 	




@endsection

