
@extends('layouts.frontend')
@section('title')
    My Courses
@endsection

@section('content')
    <div class="container">
     <!-- model -->
     <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Upload File</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    Lecture Notes
            <div id="showfiles0">
                   
            </div>
        <hr>
        Sections Notes
            <div id="showfiles1">
                   
            </div>
        <hr>
     <!-- upload file form in model -->
                    <form action="{{url('/professor/upload')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="file">
                        <input type="hidden" name="cid" id='cid'>
                        <input type="submit" value="Upload" class="button alt">
                    </form>
                </div>
            </div>
        </div>
    </div>
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>CourseCode</th>
                <th>Name</th>
                <th>اسم</th>
                <th>Total Grade</th>
                <th>Hours</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $obj)
                <tr>

                    <td>{{$obj->courseCode}}</td>
                    <td>{{$obj->englishName}}</td>
                    <td>{{$obj->arabicName}}</td>
                    <td>{{$obj->totalGrade}}</td>
                    <td>{{$obj->hours}}</td>

                    <td>
                        <a href="{{url('/professor/students/'.$obj->id)}}" class="btn btn-primary" ><i class="fa fa-eye" aria-hidden="true"></i> Show Students</a>
                    <a  href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getcourseid({{$obj->id}})"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload File</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<script>

function getcourseid(id) {
        document.getElementById("cid").value=id;
        var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
           if(arr['reply']){
                alert(arr['reply']); 
                document.getElementById("showfiles0").innerHTML ='';
                document.getElementById("showfiles1").innerHTML ='';
            }else{
                document.getElementById("showfiles0").innerHTML = arr[0];
                document.getElementById("showfiles1").innerHTML = arr[1];
            }
    }
  };  
  http.open("GET","{{url('/professor/files')}}"+'/?id='+id,true);
  http.send();

    }





</script>









@endsection
