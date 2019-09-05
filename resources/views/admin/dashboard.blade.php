
@extends('index')
@section('title')
   Dashboard
@endsection
@section('dashboardActive')
	class="active"
@endsection

@section('extrastyle')
	<style type="text/css">
		.count{
			display: block;
			width: 32%;
			float: left;
			height:300px;
			border:1px solid #747d8c;
			border-radius: 10px;
			margin: 15px 1% 15px 0;
			color:#fff

		}
		.customRow{
			overflow: hidden
		}
		.count span{
			display:block;
			text-align:center
		}
		.count div{
			height:250px;
			text-align:center;
			font-size:160px
		}
		.student{
			background-color: #2980b9
		}
		.professor{
			background-color: #c0392b
		}
		.assistant{
			background-color: #27ae60
		}
		.course{
			background-color: #f39c12
		}
		.lecture{
			background-color: #8e44ad
		}.section{
			background-color: #f1c40f
		}
		div h1{
			color: #796AEE;
			margin-top: 20px;
			font-style: italic;
		}
		.btn-link{
			color: #796AEE !important
		}
	</style>
@endsection

@section('content')
<div class="container" style="margin-top: 20px">
	<div>
		<a href="{{url('/admin/supportterm')}}" class="btn btn-primary" onclick="return confirm('Are You Sure You Want To End The Current Semester ?!')"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Semester Approval</a>
		<a href="{{url('/admin/setting')}}" class="btn btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> Settings </a>
	</div>
	<hr>
		<canvas id="myChart"></canvas>
	<hr>
	<div class="customRow">
		<h1>Users counts</h1>
		<div  class="count student">
			<div>{{$student_count}}</div>
			<span>Student</span>
		</div>
		<div  class="count professor">
			<div>{{$professor_count}}</div>
			<span>Professor</span>
		</div>
		<div  class="count assistant">
			<div>{{$assistant_count}}</div>
			<span>Assistant</span>
		</div>
	</div>
	<hr>
	<div class="customRow">
		<h1>Components counts</h1>
		<div  class="count course">
			<div>{{$course_count}}</div>
			<span>Course</span>
		</div>
		<div  class="count lecture">
			<div>{{$lecture_count}}</div>
			<span>Lecture</span>
		</div>
		<div  class="count section">
			<div>{{$section_count}}</div>
			<span>Section</span>
		</div>
	</div>
	<hr>
	<div class="accordion" id="accordion">
	  <div class="card">
	    <div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          Top 10 Level 2 Students
	        </button>
	      </h5>
	    </div>
	    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
	      <div class="card-body">
	        <table id="bootstrap-data-table" class="table table-striped table-bordered">
	            <thead class="bg-primary" style="color:#fff" >
	                <tr>
	                    <th>id</th>
	                    <th>Name</th>
	                    <th>GPA</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($level2 as $student)
	                    <tr>
	                        <td>{{$student->id}}</td>
	                        <td>{{$student->englishName}}</td>
	                        <td>{{$student->GPA}}</td>
	                    </tr>	
	                @endforeach       
	            </tbody>
	        </table>
	      </div>
	    </div>
	  </div>

	  <div class="card">
	    <div class="card-header" id="headingTwo">
	      <h5 class="mb-0">
	        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	          Top 40 Level 3 Students
	        </button>
	      </h5>
	    </div>
	    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
	      <div class="card-body">
	        <table id="bootstrap-data-table" class="table table-striped table-bordered">
	            <thead class="bg-primary" style="color:#fff" >
	                <tr>
	                    <th>id</th>
	                    <th>Name</th>
	                    <th>Department</th>
	                    <th>GPA</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($level3 as $student)
	                    <tr>
	                        <td>{{$student->id}}</td>
	                        <td>{{$student->englishName}}</td>
	                        <td>{{$student->department->symbol}}</td>
	                        <td>{{$student->GPA}}</td>
	                    </tr>	
	                @endforeach       
	            </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-header" id="headingThree">
	      <h5 class="mb-0">
	        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	          Collapsible Group Item #3
	        </button>
	      </h5>
	    </div>
	    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
	      <div class="card-body">
	        <table id="bootstrap-data-table" class="table table-striped table-bordered">
	            <thead class="bg-primary" style="color:#fff" >
	                <tr>
	                    <th>id</th>
	                    <th>Name</th>
	                    <th>Department</th>
	                    <th>GPA</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($level4 as $student)
	                    <tr>
	                        <td>{{$student->id}}</td>
	                        <td>{{$student->englishName}}</td>
	                        <td>{{$student->department->symbol}}</td>
	                        <td>{{$student->GPA}}</td>
	                    </tr>	
	                @endforeach       
	            </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
	</div>
	<hr>
	<div>
		<h1>Departments</h1>
		<table id="bootstrap-data-table" class="table table-striped table-bordered">
	            <thead class="bg-primary" style="color:#fff" >
	                <tr>
	                    <th>Department</th>
	                    <th>Symbol</th>
	                    <th>Number Of Students</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($departments as $department)
	                    <tr>
	                        <td>{{$department->name}}</td>
	                        <td>{{$department->symbol}}</td>
	                        <td>{{$department->students()->count()}}</td>
	                    </tr>	
	                @endforeach       
	            </tbody>
	        </table>
	</div>
</div>

@php 
	use App\Result;
	if(!Result::count()){
		$Firstvalue=0;
		$second=0;
	}else{
$Firstvalue= (Result::where('rate','!=','F')->count()/Result::count()*100);
$second= (Result::where('rate','F')->count()/Result::count()*100);
}
@endphp
@endsection
@section('extrascripts')
	<script src="{{asset('/assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
	<script type="text/javascript">
		var ctx = document.getElementById('myChart').getContext('2d');
		var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
    	labels: ["Success Of Students", "Failure Of Students"],
        datasets: [{
            backgroundColor: ['rgb(39, 174, 96)','rgb(192, 57, 43)'],
            borderColor: 'rgb(255, 99, 132)',
            data: [{{$Firstvalue}}, {{$second}}],
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    suggestedMax:100
                }
            }]
        },
        legend: {
        display: false
    },
    }
});
	</script>
@endsection