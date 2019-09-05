@extends('index')

@section('extrastyle')
    <style type="text/css">
        td a {
            margin-top: 10px
        }
    </style>
@endsection
@section('title')
  Courses Dashboard
@endsection
@section('coursesActive')
  class="active"
@endsection
@section('content')
    <div class="container">
        <div>
          <span style="display: flex;float: right;height: 35px;width:40px;background-color:#dfe4ea;color: #fff;align-items: center;justify-content: center;margin-top: 10px">
            <i class="icon-search" ></i>
          </span>
          <input list='coursesname'  placeholder="Search.." name="search" style="width: 300px;height: 35px; float: right; margin-top: 10px;padding: 0 10px" onkeyup="admin_search(this.value)">
            <datalist id="coursesname">
            @foreach($course as $ob)
            <option value="{{$ob->englishName}}">
            </option>
            @endforeach
          </datalist>
          <a class='btn btn-primary' href="{{url('/admin/addcourse')}}" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Course</a>
        </div>
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead class="bg-primary" style="color:#fff">
                <tr>
                    <th onclick="orderbytable('englishName')">Name</th>
                    <th onclick="orderbytable('courseCode')">Code</th>
                    <th onclick="orderbytable('hours')">Hours</th>
                    <th onclick="orderbytable('departmentId')">Department</th>
                    <th onclick="orderbytable('available')">Status</th>
                    <th onclick="orderbytable('category')">Category</th>
                    <th onclick="orderbytable('prerequisiteCourseId')">Prerequisite</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="showcoursesinfo">
                @foreach($course as $obj)
                    <tr>
                        <td>{{$obj->englishName}}</td>
                        <td>{{$obj->courseCode}}</td>
                        <td>{{$obj->hours}}</td>
                        <td>{{$obj->department->symbol}}</td>
                        <td>{{$obj->available}}</td>
                        <td>
                            @if($obj->category)
                                Mandatory
                            @else
                                Optional
                            @endif
                        </td>
                        <td>
                            @isset($obj->prerequisiteCourse)
                            {{$obj->prerequisiteCourse->courseCode}}
                            @endisset
                        </td>
                        <td>
                            <a href="{{url('/admin/updatecourse/'.$obj->id)}}" class="btn btn-primary" ><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                            <a href="{{url('/admin/showEvaluations/'.$obj->id)}}" class="btn btn-primary" ><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Evaluations</a>
                            @if($obj->available)
                                <a href="{{url('/admin/showcoursestudents/'.$obj->id)}}" class="btn btn-primary"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Students</a>
                            @endif
                            <a href="{{url('/admin/courses/'.$obj->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Course')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>   
                @endforeach       
            </tbody>
        </table>
     </div>
@endsection

@section('extrascripts')
<script type="text/javascript">
    function admin_search(key){
var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
          document.getElementById("showcoursesinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/search/?key=')}}"+key+'&&tabletype='+'courses',true);
  http.send();
    }
    function orderbytable(column){
var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
         if(arr['reply']){
            alert(arr['reply']);
         }else
          document.getElementById("showcoursesinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/order/?column=')}}"+column+'&&type='+'course',true);
  http.send();

}

</script>
@endsection