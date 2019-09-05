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
    action="{{url('/assistants/add')}}"
@endsection
@section('mainvalue')
@foreach($all as $obj)
<option value="{{$obj->id}}" 
	@if(old('mainDepartmentId')==$obj->id) selected @endif
>{{$obj->name}}</option>
@endforeach
@endsection

@section('requirePassword')
	required
@endsection

@section('e_namevalue')
		value="{{old('englishName')}}"
@endsection

@section('a_namevalue')
		value="{{old('arabicName')}}"
@endsection

@section('usernamevalue')
		value="{{old('username')}}"
@endsection

@section('emailvalue')
		value="{{old('email')}}"
@endsection

@section('ssnvalue')
		value="{{old('SSN')}}"
@endsection


@section('malevalue')
		@if(old('gender')=='Male')
			checked
		@endif
@endsection
@section('femalevalue')
		@if(old('gender')=='Female')
			checked
		@endif
@endsection

@section('salaryvalue')
		value="{{old('salary')}}"
@endsection