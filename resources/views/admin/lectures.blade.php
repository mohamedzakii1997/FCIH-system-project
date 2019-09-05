@extends('index')

@section('title')
  Lectures Dashboard
@endsection
@section('appointmentActive')
  class="active"
@endsection
@section('lecturesActive')
  class="active"
@endsection

@section('content')
 <div class="container">
          <a href="{{url('admin/lectures/add')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Lecture</a>
              <table class="table table-bordered table-striped">
                <thead  class="bg-primary" style="color:#fff">  
                      <tr>
                        <th>Professor</th>
                        <th>Course Code</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Prof Picture</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                <tbody>
                	@foreach($all as $lec)
                	<tr>
                		<td>
                		{{$lec->professor->englishName}}	
                		</td>
                		<td>
                		{{$lec->course->courseCode}}	
                		</td>	
                		<td>
                		{{$lec->location}}	
                		</td>
                		<td>
                		{{$lec->duration}}
                		</td>
                    <td><img src="{{asset('storage/'.$lec->professor->profilePicture)}}" width="100" height="70" align="-"></td>
                        <td>
                        	<a href="{{url('admin/lectures/update/'.$lec->id)}}" class="btn btn-primary" ><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                        	<a href="{{url('admin/lectures/delete/'.$lec->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </td>
                	</tr>
                	@endforeach
                 </tbody>
                  </table>
                </div>    

           @endsection     