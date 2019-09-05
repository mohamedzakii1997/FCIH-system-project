@extends('layouts.frontend')
@section('title')
My Courses
@endsection

@section('extraStyle')
.star-rating {
    direction: rtl;
    display: inline-block;
    padding: 20px
}

.star-rating input[type=radio] {
    display: none !important
}
input[type="checkbox"] + label:before, input[type="radio"] + label:before{
	display:none !important
}

.star-rating label {
    color: #bbb;
    font-size: 18px;
    padding: 0;
    cursor: pointer;
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input[type=radio]:checked ~ label {
    color: #f2b600
}
input[type="checkbox"] + label, input[type="radio"] + label{
	padding-left:10px
}
.fa-star{
	font-size:20px
}
@endsection

@section('content')
<div class="container">
		<h1 style="font-size: 30px">My Courses</h1>
		<table class="table table-bordered">
			 <thead>
			    <tr>
				    <th scope="col">Code</th>
				    <th scope="col">Name</th>
				    <th>اسم</th>
				    <th scope="col">Hours</th>
				    <th scope="col">Midterm Grade</th>
				    <th scope="col">Class Work Grade</th>
				    <th>Evaluation</th>
			    </tr>
			 </thead>
			 <tbody>
			 	@foreach($registrations as $registration)
			 		<tr>
			 			<td>{{$registration->course->courseCode}}</td>
			 			<td>{{$registration->course->englishName}}</td>
			 			<td>{{$registration->course->arabicName}}</td>
			 			<td>{{$registration->course->hours}}</td>
			 			<td>{{$registration->midtermGrade}}</td>
			 			<td>{{$registration->classworkGrade}}</td>
			 			<td><a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick="getCourse({{$registration->course->id}})"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Evaluate</a>
			 			<a href="#"  data-toggle="modal" data-target="#myModal2" class="btn btn-primary" onclick="getcourseResources({{$registration->course->id}})"><i class="fa fa-file" aria-hidden="true"></i> Resources</a>
          </td>
			 		</tr>
				@endforeach
			 </tbody>
		</table>
	</div>
	{{-- Start Model --}}
	<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="exampleModalLabel" class="modal-title">Evaluate Course</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <form action="{{url('student/evaluate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="courseId" id="courseId" value="">
                <div class="form-group row">
                  <label class="col-sm-3 form-control-label" style="margin-top: 20px">Rate</label>
                  <div class="col-sm-9">
                  	<div class="col-sm-9 star-rating">
		      		<input id="star-5" type="radio" name="value" value="10">
					<label for="star-5" title="10">
							<i class="active fa fa-star" aria-hidden="true"></i>
					</label>
					<input id="star-4" type="radio" name="value" value="8">
					<label for="star-4" title="8">
							<i class="active fa fa-star" aria-hidden="true"></i>
					</label>
					<input id="star-3" type="radio" name="value" value="6">
					<label for="star-3" title="6">
							<i class="active fa fa-star" aria-hidden="true"></i>
					</label>
					<input id="star-2" type="radio" name="value" value="4">
					<label for="star-2" title="4">
							<i class="active fa fa-star" aria-hidden="true"></i>
					</label>
					<input id="star-1" type="radio" name="value" value="2">
					<label for="star-1" title="2">
							<i class="active fa fa-star" aria-hidden="true"></i>
					</label>
                  </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
					 <label class="form-control-label" style="margin-top: 40px">Your Note About The Course</label>
                	<textarea name="note" placeholder="Optional" class="form-control" style="height: 100px"></textarea>
				</div>                       
                  <input type="submit" value="Evaluate" class="btn btn-primary" style="margin-top: 40px">
              </form>
            </div>
          </div>
        </div>
      </div>

      <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="exampleModalLabel" class="modal-title">Evaluate Course</h4>
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


            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
	function getCourse(id){
		document.getElementById('courseId').setAttribute('value',id);
	}
	function getcourseResources(id) {
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
  http.open("GET","{{url('/student/coursefiles')}}"+'/?courseId='+id,true);
  http.send();

    }
</script>
@endsection