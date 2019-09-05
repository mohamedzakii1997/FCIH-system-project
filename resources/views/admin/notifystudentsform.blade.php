@extends('layouts.notifyform')

@section('title')
  Students Dashboard
@endsection
@section('studentsActive')
  class="active"
@endsection
@section('action')

action="{{url('/admin/students/notify')}}"
@endsection