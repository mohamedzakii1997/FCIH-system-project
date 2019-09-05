@extends('layouts.frontend')

@section('title')
My Lectures Table
@endsection

@section('extraStyle')
	thead tr th{
	text-align:center
}
td div{
	text-align:center
}
td .course{
	font-weight:bold;
}
td .professor{
	font-size:12px
}
td .location{
	font-size:9px
}
@endsection

@section('content')

<div class="container">
		<table class="table table-bordered">
			 <thead>
			    <tr>
                    <th>day</th>
                    <th scope="col">8</th>
				    <th scope="col">9</th>
				    <th scope="col">10</th>
				    <th scope="col">11</th>
				    <th scope="col">12</th>
				    <th scope="col">1</th>
				    <th scope="col">2</th>
				    <th scope="col">3</th>
				    <th scope="col">4</th>
				    <th scope="col">5</th>
				    <th scope="col">6</th>
				    <th scope="col">7</th>
				    <th scope="col">8</th>
				    <th scope="col">9</th>
			    </tr>
			 </thead>
<tbody>

@php $days=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday'] @endphp
@for($q=0;$q<count($mylectures);$q++)
@if($maxes[$q]!=0)
	<tr>
		<td  rowspan="{{$maxes[$q]}}">{{$days[$q]}}</td>

		@php
		    $lectures=$mylectures[$q];
			$lastLecture=null;
			$flag=false;
		@endphp
		@for($r=0;$r<$maxes[$q];$r++)
			@if($flag)
				<tr>
			@endif
		@for($k=0;$k<$lectures->count(); $k++)
			@if(empty($lastLecture))
					@for($i=0;$i<($lectures[$k]->time-8);$i++)
						<td></td>
					@endfor
					<td colspan="{{$lectures[$k]->duration}}">
						<div class="course">{{$lectures[$k]->course->englishName}}</div>
						<div class="professor">Prof: {{$lectures[$k]->professor->englishName}}</div>
						<div class="location">{{$lectures[$k]->location}}</div>
					</td>
					@php
						$lastLecture=$lectures[$k];
						$lectures->forget($k);
						$k--;
						$lectures=$lectures->values();
					@endphp
                    
                    @if($lectures->count()==0)
             
                       @for($g=0;$g<22-($lastLecture->time+$lastLecture->duration);$g++)
						<td></td>
					    @endfor
					   </tr> 
                    @endif 
			@else
				@if($lectures[$k]->time >=$lastLecture->time && $lectures[$k]->time<($lastLecture->time+$lastLecture->duration))
				@if(!(($k+1)<$lectures->count())) 
				   
                     @for($f=0;$f<22-($lastLecture->time+$lastLecture->duration);$f++)
						      <td></td>
					      @endfor
					   </tr> 
				   @php 
				       $flag=true; $lastLecture=null; 
				   @endphp 
				@endif
					@continue;

				@else
					@for($i=0;$i<($lectures[$k]->time-($lastLecture->time+$lastLecture->duration));$i++)
						<td></td>
					@endfor
					<td colspan="{{$lectures[$k]->duration}}">
						<div class="course">{{$lectures[$k]->course->englishName}}</div>
						<div class="professor">Prof: {{$lectures[$k]->professor->englishName}}</div>
						<div class="location">{{$lectures[$k]->location}}</div>
					</td>
				@endif
				@if($k==$lectures->count()-1)
					@for($i=0;$i<22-($lectures[$k]->time+$lectures[$k]->duration);$i++)
						<td></td>
					@endfor
					</tr>
					@php
						$lectures->forget($k);
						$k--;
						$lectures=$lectures->values();
						$lastLecture=null;
						$flag=true;
						break;
					@endphp
				@else
					@php
						$lastLecture=$lectures[$k];
						$lectures->forget($k);
						$k--;
						$lectures=$lectures->values();
					@endphp
				@endif

			@endif

		@endfor
		@endfor
@else
<tr>
<td>{{$days[$q]}}</td>
	@for($i=0;$i<14;$i++)
		<td></td>
	@endfor
</tr>	
@endif

@endfor




</tbody>

		</table>


	</div>	



@endsection