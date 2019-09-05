@extends('layouts.frontend')
@section('title')
    My Students
@endsection
@section('content')

    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>اسم</th>
                <th>Level</th>
                <th>Department</th>
                <th>Midterm</th>
                <th>Class Work</th>
                <td>Image</td>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($student_info as $obj)
                <tr>
                    <td>{{$obj->student->id}}</td>
                    <td>{{$obj->student->englishName}}</td>
                    <td>{{$obj->student->arabicName}}</td>
                    <td>{{$obj->student->level}}</td>
                    <td>{{$obj->student->mainDepartmentId}}</td>
                    <td>{{$obj->midtermGrade}}</td>
                    <td>{{$obj->classworkGrade}}</td>
                    <td><img src="{{asset('storage/'.$obj->student->profilePicture)}}" width="100" height="70" alt="-"></td>
                    <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getstudentid({{$obj->student->id}})">
                            <i class="fa fa-signal" aria-hidden="true"></i> Assign Midterm Grade</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- model -->
    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Professor Assignment</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/professor/assigngrade')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="student_id" id="stid">
                        <input type="hidden" name="course_id" value="{{$id}}">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Grade</label>
                            <div class="col-sm-9">

                                <input type="number" name="student_grade">

                            </div>
                        </div>

                        <input type="submit" value="Assign" class="button alt" style="margin-top: 20px">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end model-->

<script>
    function getstudentid(id) {
        document.getElementById("stid").value=id;
    }
</script>








@endsection