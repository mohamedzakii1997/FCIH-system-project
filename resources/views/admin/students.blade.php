@extends('index')


@section('title')
  Students Dashboard
@endsection
@section('studentsActive')
  class="active"
@endsection

@section('content')

 <div class="container">
        <div>
          <span style="display: flex;float: right;height: 35px;width:40px;background-color:#dfe4ea;color: #fff;align-items: center;justify-content: center;margin-top: 10px">
            <i class="icon-search" ></i>
          </span>
          <input list='studentsname'  placeholder="Search.." name="search" style="width: 300px;height: 35px; float: right; margin-top: 10px;padding: 0 10px" onkeyup="admin_search(this.value)">
            <datalist id="studentsname">
            @foreach($all_student as $ob)
            <option value="{{$ob->englishName}}">
            </option>
            @endforeach
          </datalist>


      <a href="{{url('admin/students/add')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Student</a>
      <a href="{{url('admin/students/notify')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-bell" aria-hidden="true"></i> Notify Students</a>
    </div>
      <table class="table table-striped table-bordered">
        <thead  class="bg-primary" style="color:#fff">         
                      <tr>
                        <th onclick="orderbytable('id')">Id</th>
                        <th onclick="orderbytable('englishName')">Name</th>
                        <th onclick="orderbytable('email')">Email</th>
                        <th onclick="orderbytable('level')">Level</th>
                        <th onclick="orderbytable('username')">Username</th>
                        <th onclick="orderbytable('mainDepartmentId')">Department</th>
                        <th>Image</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                <tbody id="showstudentsinfo">
               @foreach($all_student as $obj)
                 <tr>
                  <td>{{$obj->id}}</td>
                     <td>{{$obj->englishName}}</td>
                   <td>{{$obj->email}}</td>
                  <td>{{$obj->level}}</td>
                  <td>{{$obj->username}}</td>
                  <td>{{$obj->department->name}}</td>
                  <td><img src="{{asset('storage/'.$obj->profilePicture)}}" width="100" height="70" alt="-"></td>
                  <td><a href="{{url('admin/students/update/'.$obj->id)}}" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                  <a href="{{url('admin/students/delete/'.$obj->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete?')" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></td>           
                 </tr>  
                  @endforeach
                      
                       </tbody>
                  </table>
                  </div>
               
       {{ $all_student->links() }}
@endsection

@section('extrascripts')
<script type="text/javascript">
    function admin_search(key){
var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
          document.getElementById("showstudentsinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/search/?key=')}}"+key+'&&tabletype='+'student',true);
  http.send();
    }
function orderbytable(column){
var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
        if(arr['reply']){
         alert(arr['reply']);
        }
          else
          document.getElementById("showstudentsinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/order/?column=')}}"+column+'&&type='+'student',true);
  http.send();

}

</script>
@endsection