@extends('layouts.departmentForm')
@section('action')
    action="{{url('/admin/addDepartment')}}"
@endsection
@section('namevalue')
    value="{{old('name')}}"
@endsection
@section('symbolvalue')
    value="{{old('symbol')}}"
@endsection

@section('optional')
	@if(old('optional'))
    	value="{{old('optional')}}"
    @endif

@endsection