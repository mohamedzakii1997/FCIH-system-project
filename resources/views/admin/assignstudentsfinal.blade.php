@extends('index')

@section('title')
  available Courses Dashboard
@endsection

@section('content')
<div class="container">
              <table class="table table-striped table-bordered" style="margin-top: 10px">
                <thead  class="bg-primary" style="color:#fff" >  
             
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Final Grade</th>
                        <th>Image</th>
                        <th>options</th>
                      </tr>
                    </thead>


                     
                   <tbody>
                   	@foreach($students as $obj)
                   	<tr>
                      <td>{{$obj->id}}</td>
                     <td>{{$obj->englishName}}</td>
                     <td>{{$obj->registrations()->where('courseId',$id)->first()->fingalGrade}}</td>
                     <td><img src="{{asset('storage/'.$obj->profilePicture)}}" width="100" height="70" alt="-"></td>
                     <td><a  href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-primary"  onclick="getids('{{$obj->pivot->courseId}}','{{$obj->pivot->studentId}}')"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Assign Grade</a></td>
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
                    <h4 id="exampleModalLabel" class="modal-title">Final Grade</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
     <!-- upload file form in model -->
                    <form action="{{url('/admin/assignstudentfinal')}}" method="post">
                        {{ csrf_field() }}
                        <input type="number" name="grade" placeholder="Final Grade"><br>
                        <input type="hidden" name="cid" id='cid'>
                        <input type="hidden" name="sid" id='sid'>
                        <input type="submit" value="assign" class="btn btn-primary" style="margin-top: 20px">
                    </form>
                </div>
            </div>
        </div>
    </div>      
           
<script>

function getids(id,sid) {
        document.getElementById("cid").value=id;      
document.getElementById("sid").value=sid;
    }





</script>


@endsection      