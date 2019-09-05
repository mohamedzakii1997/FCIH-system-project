@extends('index')
@section('title')
  Courses Evaluations
@endsection
@section('coursesActive')
  class="active"
@endsection
@section('content')
    <div class="container">
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead class="bg-primary" style="color:#fff">
                <tr>
                    <th>Student Name</th>
                    <th>اسم الطالب</th>
                    <th>Student Id</th>
                    <th>Value</th>
                    <th>Image</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluations as $evaluation)
                    <tr>
                        <td>{{$evaluation->student->englishName}}</td>
                        <td>{{$evaluation->student->arabicName}}</td>
                        <td>{{$evaluation->student->id}}</td>
                        <td>{{$evaluation->value}}</td>
                        <td><img src="{{asset('storage/'.$evaluation->student->profilePicture)}}" width="100" height="70" alt="-"></td>
                        <td>{{$evaluation->note}}</td>
                    </tr>	
                @endforeach       
            </tbody>
        </table>
     </div>
@endsection