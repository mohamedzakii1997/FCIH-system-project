@extends('layouts.lectureform')
@section('title')
  Lectures Dashboard
@endsection
@section('appointmentActive')
  class="active"
@endsection
@section('lecturesActive')
  class="active"
@endsection
@section('action')
    action="{{url('admin/lectures/add')}}"
 @endsection
@section('profselect')
    @foreach($profs as $obj)
<option value="{{$obj->id}}"
	@if(old('professorId')==$obj->id)
		selected
	@endif 
	>{{$obj->englishName}}</option>
    @endforeach
  @endsection

@section('courseselect')
    @foreach($courses as $obj)
        <option value="{{$obj->id}}"
        	@if(old('courseId')==$obj->id)
        		selected
        	@endif 

        	>{{$obj->courseCode}} | {{$obj->englishName}}</option>
        @endforeach
@endsection

@section('duration')
	@if(old('duration'))
		value={{old('duration')}}
	@else
    	value="3"
    @endif
 @endsection

 @section('location')
  @if(old('location'))
    value={{old('location')}}
    @endif
 @endsection
 @section('time')
  @if(old('time'))
    value={{old('time')}}
  @endif
 @endsection

 @section('day')
    <select id="inputHorizontalSuccess" class="form-control form-control-success" name="day" required>
                            <option value="0">Saturday</option>
                            <option value="1" @if(old('day')&&old('day')==1) selected @endif)>Sunday</option>
                            <option value="2" @if(old('day')&&old('day')==2) selected @endif)>Monday</option>
                            <option value="3" @if(old('day')&&old('day')==3) selected @endif)>Tuesday</option>
                            <option value="4" @if(old('day')&&old('day')==4) selected @endif)>Wednesday</option>
                            <option value="5" @if(old('day')&&old('day')==5) selected @endif)>Thursday</option>
                        </select>
 @endsection