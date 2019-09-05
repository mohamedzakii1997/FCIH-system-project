
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
  <div>
          <span style="display: flex;float: right;height: 35px;width:40px;background-color:#dfe4ea;color: #fff;align-items: center;justify-content: center;margin-top: 10px">
            <i class="icon-search" ></i>
          </span>
          <input list='coursesname'  placeholder="Search.." name="search" style="width: 300px;height: 35px; float: right; margin-top: 10px;padding: 0 10px" onkeyup="admin_search(this.value)">
            <datalist id="coursesname">
            @foreach($assistants as $ob)
            <option value="{{$ob->englishName}}">
            </option>
            @endforeach
          </datalist>
   
            <a href="{{url('assistants/add')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Assistant</a>
            <a href="{{url('assistants/showcourses')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-address-book" aria-hidden="true"></i> Assistants Assignments</a>
             <a href="{{url('assistants/notify')}}" class="btn btn-primary" style="margin: 10px 0px;"><i class="fa fa-bell" aria-hidden="true"></i> Notify Assistants</a>
           </div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead class="bg-primary" style="color:#fff">
                                <tr>
                                    <th onclick="orderbytable('englishName')">Name</th>
                                    <th onclick="orderbytable('email')">Email</th>
                                    <th onclick="orderbytable('salary')">Salary</th>
                                    <th onclick="orderbytable('mainDepartmentId')">Department</th>
                                    <th>Image</th>
                                    <th>Options</th>
                                </tr>
                                </thead >
                                <tbody id="showasisstantsinfo">
                                @foreach($assistants as $ar)
                                    <tr>
                                        <td>{{$ar->englishName}}</td>
                                        <td>{{$ar->email}}</td>
                                        <td>{{$ar->salary}}</td>
                                        <td>{{$ar->department->name}} </td>
                                        <td><img src="{{asset('storage/'.$ar->profilePicture)}}" width="100" height="70" alt="-"></td>
                                        <td>

                                  <a href="{{url('assistants/update/'.$ar->id)}}" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Edit </a>
                                                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getsecid({{$ar->id}})"><i class="fa fa-address-book" aria-hidden="true"></i> Assign</button>
                                                    <a href="{{url('assistants/delete/'.$ar->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Assistant')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            
                            </table>
            </div><!-- .content -->

            <!-- model -->
            <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="exampleModalLabel" class="modal-title">Assistant Assignment</h4>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/assistants/assign')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="ass_id" id="assid">
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Course</label>
                                    <div class="col-sm-9">
                                        <select id="show" class="form-control" name="courseid" style="width: 200px;" required>
                                        </select>
                                    </div>
                                </div>

                                <input type="submit" value="Assign" class="btn btn-primary">
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
    function getsecid(id){

        document.getElementById("assid").value=id;
        var http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var arr= JSON.parse(this.responseText);
                if(arr['reply']){alert(arr['reply']); document.getElementById("show").innerHTML = '';}
                else
                    document.getElementById("show").innerHTML = arr;
            }
        };

        http.open("GET","{{url('/assistants/getids/?id=')}}"+id,true);
        http.send();
    }

     function admin_search(key){
       var http = new XMLHttpRequest();
        http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
          document.getElementById("showasisstantsinfo").innerHTML = arr;
        }
    };  

    http.open("GET","{{url('/admin/search/?key=')}}"+key+'&&tabletype='+'assistant',true);
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
          document.getElementById("showasisstantsinfo").innerHTML = arr;
    }
  };  

  http.open("GET","{{url('/admin/order/?column=')}}"+column+'&&type='+'assistant',true);
  http.send();

}
</script>
@endsection
