@extends('index')
@section('title')
  Sections Dashboard
@endsection
@section('appointmentActive')
  class="active"
@endsection
@section('sectionsActive')
  class="active"
@endsection
@section('content')



    <div class="container">
            <a href="{{url('sections/add')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Section</a>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead class="bg-primary" style="color:#fff">
                                <tr>
                                    <th>Assistant </th>
                                    <th>Course Code</th>
                                    <th>Location</th>
                                    <th>Duration</th>
                                    <th>Assistant Picture</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $ar)
                                    <tr>
                                        <td>{{$ar->course->courseCode}}</td>
                                        <td>{{$ar->assistant->englishName}}</td>
                                        <td>{{$ar->location}}</td>
                                        <td>{{$ar->duration}}</td>
                                        <td><img src="{{asset('storage/'.$ar->assistant->profilePicture)}}" width="100" height="70" align="-"></td>
                                        <td>

                                                <a href="{{url('sections/update/'.$ar->id)}}" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>

                                                <a href="{{url('sections/delete/'.$ar->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Assistant')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>

@endsection
