@extends('layouts.studentsform')

@section('action')
action={{url('admin/students/add')}}
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

@section('mainDepartmentId')
	<input type="hidden" name="mainDepartmentId" value="1">
@endsection