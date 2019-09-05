@extends('layouts/courseForm')
@section('action')
    action="{{url('/admin/addcourse')}}"
@endsection
@section('e_namevalue')
    value="{{old('englishName')}}"
@endsection
@section('a_namevalue')
    value="{{old('arabicName')}}"
@endsection
@section('coursecodevalue')
    value="{{old('courseCode')}}"
@endsection
@section('totalgradevalue')
	@if(old('totalGrade'))
		value="{{old('totalGrade')}}"
	@else
		value="100"
	@endif
@endsection

@section('finalgradevalue')
	@if(old('finalGrade'))
		value="{{old('finalGrade')}}"
	@else
		value="60"
	@endif
@endsection

@section('midtermgradevalue')
	@if(old('midtermGrade'))
		value="{{old('midtermGrade')}}"
	@else
		value="20"
	@endif
@endsection

@section('hoursvalue')
	@if(old('hours'))
		value="{{old('hours')}}"
	@else
		value="3"
	@endif
@endsection

@if(old("available")==1)
    @section('availablevalue')
        checked
    @endsection
@elseif(old("available")==0)
	@section('notavailablevalue')
        checked
    @endsection
@endif

@if(old("category")==1)
    @section('mandatory')
        checked
    @endsection
@elseif(old("category")==0)
	@section('optional')
        checked
    @endsection
@endif

@section('courseid')
    @for($i=0;$i<count($courses);$i++)       
        <option value="{{$courses[$i]->id}}"
        		@if(old('prerequisiteCourseId')==$courses[$i]->id)
        			selected
        		@endif
        	>
        	 {{$courses[$i]->englishName }} | {{ $courses[$i]->courseCode }} 
    	</option>
    @endfor
@endsection
@section('departmentid')
	@foreach($department as $dept)
		<option value="{{$dept->id}}" 
			@if(old('departmentId')==$dept->id)
				selected
			@endif
			>{{$dept->name}}
		</option>
	@endforeach
@endsection