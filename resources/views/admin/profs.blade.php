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
                <div>
          <span style="display: flex;float: right;height: 35px;width:40px;background-color:#dfe4ea;color: #fff;align-items: center;justify-content: center;margin-top: 10px">
            <i class="icon-search" ></i>
          </span>
          <input list='coursesname'  placeholder="Search.." name="search" style="width: 300px;height: 35px; float: right; margin-top: 10px;padding: 0 10px" onkeyup="admin_search(this.value)">
            <datalist id="coursesname">
            @foreach($profs as $ob)
            <option value="{{$ob->englishName}}">
            </option>
            @endforeach
          </datalist>

                <a href="{{url('admin/professors/add')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Professor</a>
                <a href="{{url('admin/professors/showprofs')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-address-book" aria-hidden="true"></i> Professors Assignments</a>
                <a href="{{url('admin/professors/notify')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-bell" aria-hidden="true"></i> Notify Professors</a>
              </div>
                <table class="table table-striped table-bordered">
                <thead  class="bg-primary" style="color:#fff" >  
                      <tr>
                        <th onclick="orderbytable('englishName')">Name</th>
                        <th onclick="orderbytable('email')">Email</th>
                        <th onclick="orderbytable('salary')">Salary</th>
                        <th onclick="orderbytable('mainDepartmentId')">Department</th>
                        <th>Image</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody id="showprofessorsinfo">
               @foreach($profs as $obj)
                 <tr>
                     <td>{{$obj->englishName}}</td>
                   <td>{{$obj->email}}</td>
                  <td>{{$obj->salary}}</td>
                  <td>{{$obj->department->name}}</td>
                  <td><img src="{{asset('storage/'.$obj->profilePicture)}}" width="100" height="70" alt="-"></td>
                  <td><a href="{{url('admin/professors/update/'.$obj->id)}}" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getid({{$obj->id}})"><i class="fa fa-address-book" aria-hidden="true"></i> Assign</button>
                  <a href="{{url('admin/professors/delete/'.$obj->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                 <!--  <a href="#" class="showModal" class="btn btn-outline-primary" onclick="getid()" style="font-size: 15px;">asign course</a>  -->  
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
                              <form action="{{url('admin/professors/assign')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="prof_id" id="profid">
                                <div class="form-group row">
                                  <label class="col-sm-3 form-control-label">Course</label>
                                  <div class="col-sm-9">
                                  <select id="show22" class="form-control" name="courseid" style="width: 200px;" required>
                                      </select>
                                             </div>
                                </div>
                                       
                                  <input type="submit" value="assign" class="btn btn-primary">
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>


<!-- end model-->      
 @endsection  

 @section('extrascripts')
  <script type="text/javascript">

function getid(id){

document.getElementById("profid").value=id;
var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
        if(arr['reply']){
            alert(arr['reply']); 
            document.getElementById("show22").innerHTML ='';
      }
        else  
          document.getElementById("show22").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/professors/getids/?id=')}}"+id,true);
  http.send();
}




    function admin_search(key){
var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
          document.getElementById("showprofessorsinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/search/?key=')}}"+key+'&&tabletype='+'professor',true);
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
          document.getElementById("showprofessorsinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/order/?column=')}}"+column+'&&type='+'professor',true);
  http.send();

}


</script>
@endsection  
