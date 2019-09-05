@extends('index')

@section('title')
  Professors Dashboard
@endsection
@section('professorsActive')
  class="active"
@endsection
@section('teachersActive')
  class="active"
@endsection
@section('content')

<div class="container">
              <table class="table table-striped table-bordered" style="margin-top: 10px">
                <thead  class="bg-primary" style="color:#fff" >  
                      <tr>
                        <th>Professor </th>
                        <th>Course </th>
                        <th>Course Code</th>
                        <th>Professor Picture</th>
                        <th>options</th>
                      </tr>
                    </thead>
                    <tbody>

                @foreach($prof_courses as $assignment)
                  <tr>
                  	<td>{{$assignment->professorName}}</td>
                    <td>{{$assignment->courseName}}</td>
                    <td>{{$assignment->courseCode}}</td>
                    <td><img src="{{asset('storage/'.$assignment->profilePicture)}}" width="100" height="70" alt="-"></td>
                    <td>              
                      <a href="{{url('admin/professors/deleteassign/'.$assignment->professorId.'/'.$assignment->courseId)}}" class="btn btn-danger   " onclick="return confirm('Are You Sure To Delete')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                    </td>
                  </tr>	
                  @endforeach
                  </tbody>
                  </table>
                </div>	




@endsection 