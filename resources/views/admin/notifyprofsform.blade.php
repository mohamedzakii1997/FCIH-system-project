@extends('layouts.notifyform')

@section('title')
  Professors Dashboard
@endsection
@section('professorsActive')
  class="active"
@endsection
@section('teachersActive')
  class="active"
@endsection

@section('action')

action="{{url('/admin/professors/notify')}}"
@endsection