@extends('index')
@section('title')
	Exceptional Requests
@endsection

@section('exceptional')
	class="active"
@endsection

@section('content')
	<div class="container">
      	<table class="table table-bordered table-striped">
	        <thead  class="bg-primary" style="color:#fff">  
             	<tr>
	                <th>Student Id</th>
	                <th>Student Name</th>
	                <th>اسم</th>
	                <th>Course Code</th>
	                <th>Course</th>
	                <th>Image</th>
	                <th>Options</th>
              	</tr>
	        </thead>
	        <tbody>
	        	@foreach($requests as $request)
	        	<tr>
	        		<td>
	        		{{$request->student->id}}	
	        		</td>
	        		<td>{{$request->student->englishName}}</td>
	        		<td>{{$request->student->arabicName}}</td>
	        		<td>
	        		{{$request->course->courseCode}}	
	        		</td>	
	        		<td>
	        		{{$request->course->englishName}}	
	        		</td>
	        		<td><img src="{{asset('storage/'.$request->student->profilePicture)}}" width="100" height="70" alt="-"></td>
	                <td>
	                	<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal"  onclick="getDetails('{{$request->reason}}','{{$request->message}}')"><i class="fa fa-info-circle" aria-hidden="true"></i> Details</a>
	                	<a href="{{url('admin/exceptionalRequests/'.$request->student->id.'?result=1')}}" class="btn btn-success" onclick="return confirm('Are You Sure To Accept')"><i class="fa fa-check" aria-hidden="true"></i> Accept</a>
	                	<a href="{{url('admin/exceptionalRequests/'.$request->student->id.'?result=0')}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Refuse')"><i class="fa fa-times" aria-hidden="true"></i> Refuse</a>
	                </td>
	        	</tr>
	        	@endforeach
	         </tbody>
        </table>
    </div> 
    {{-- Model Section --}}
    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
	    <div role="document" class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 id="exampleModalLabel" class="modal-title">Exceptional Request Content</h4>
	          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
	        </div>
	        <div class="modal-body">
	        	<label style="font-weight: bold">Reason</label>
	        	<div id="reason">
	        		
	        	</div>
	        	<hr>
	        	<label>Message</label>
	        	<textarea readonly id="message" style="display:block ; width: 100%;height:250px"></textarea>
	          
	        </div>
	      </div>
	    </div>
	</div> 

@endsection

@section('extrascripts')
	<script type="text/javascript">
		function getDetails(reason,message){
			var data=document.getElementById('details');
			document.getElementById('reason').textContent=reason;
			document.getElementById('message').textContent=message;
		}
	</script>
@endsection