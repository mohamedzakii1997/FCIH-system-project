@extends('layouts.profsform')
@section('title')
  Assistant Dashboard
@endsection
@section('assistantsActive')
  class="active"
@endsection
@section('teachersActive')
  class="active"
@endsection
@section('action')
    action="{{url('/assistants/update/'.$prof->id)}}"
@endsection
@section('e_namevalue')
	@if(old('englishName'))
		value="{{old('englishName')}}"
	
	@else
		value="{{$prof->englishName}}"
	@endif
@endsection
@section('a_namevalue')
	@if(old('arabicName'))
		value="{{old('arabicName')}}"
	@else
		value="{{$prof->arabicName}}"
	@endif
@endsection
@section('usernamevalue')
	@if(old('username'))
		value="{{old('username')}}"
	
	@else
	value="{{$prof->username}}"
	@endif
@endsection
@section('emailvalue')
	@if(old('email'))
		value="{{old('email')}}"
	
	@else
		value="{{$prof->email}}"
	@endif
@endsection
@section('ssnvalue')
	@if(old('SSN'))
		value="{{old('SSN')}}"
	
	@else
		value="{{$prof->SSN}}"
	@endif
@endsection


@if(old('gender')=="Male")
	@section('malevalue')
		checked
	@endsection
@elseif(old('gender')=='Female')
	@section('femalevalue')
		checked
	@endsection
@elseif($prof->gender=='Male')
	@section('malevalue')
		checked
	@endsection
@else
	@section('femalevalue')
		checked
	@endsection
@endif

@section('salaryvalue')
	@if(old('salary'))
		value="{{old('salary')}}"
	@else
	value="{{$prof->salary}}"
	@endif
@endsection

@if(old('mainDepartmentId'))
	@section('mainvalue')
		@foreach($all as $obj)
		<option value="{{$obj->id}}" 
			@if($obj->id==old('mainDepartmentId'))
				selected
			@endif
			>{{$obj->id}}</option>
		@endforeach
	@endsection
@else
	@section('mainvalue')
@foreach($all as $obj)
<option value="{{$obj->id}}" 
	@if($obj->id==$prof->id)
selected
@endif>{{$obj->id}}</option>
@endforeach
@endsection
@endif

