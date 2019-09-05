@extends('index')
@section('title')
  Assistant Dashboard
@endsection
@section('assistantsActive')
  class="active"
@endsection
@section('teachersActive')
  class="active"
@endsection
@section('content')
    <div class="container">

                            <table id="bootstrap-data-table" class="table table-striped table-bordered" style="margin-top:10px">
                                <thead class="bg-primary" style="color:#fff">
                                <tr>
                                    <th>Assistant</th>
                                    <th>Course</th>
                                    <th>Course Code</th>
                                    <th>Image</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                             @foreach($assis_courses as $assignment)
                                    <tr>
                                        <td>{{$assignment->assistantId}}</td>
                                        <td>{{$assignment->courseName}}</td>
                                        <td>{{$assignment->courseCode}}</td>
                                        <td><img src="{{asset('storage/'.$assignment->profilePicture)}}" width="100" height="70" alt="-"></td>
                                        <td>
                                            <a href="{{url('assistants/deleteassign/'.$assignment->assistantId.'/'.$assignment->courseId)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Assistant assign')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </td>

                                    </tr>

                                </tbody>
                                @endforeach
                            </table>
                        </div>
    </div>

@endsection