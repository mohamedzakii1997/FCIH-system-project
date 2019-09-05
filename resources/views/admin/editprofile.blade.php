@extends('editprofile')
@section('changeform')
action='{{url("admin/editprofile")}}'
@endsection

@section('image')
src="{{asset('storage/'.auth('admin')->user()->profilePicture)}}"
@endsection


