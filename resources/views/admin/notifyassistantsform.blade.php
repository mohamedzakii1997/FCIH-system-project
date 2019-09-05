@extends('layouts.notifyform')

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
action="{{url('/assistants/notify')}}"
@endsection