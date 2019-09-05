@extends('layouts.sectionform')
@section('title')
  Sections Dashboard
@endsection
@section('appointmentActive')
  class="active"
@endsection
@section('sectionsActive')
  class="active"
@endsection

@section('action')
    action="{{url('/sections/add')}}"
@endsection
@section('assistantselect')
    @foreach($assistants as $obj)
<option value="{{$obj->id}}"
	@if(old('assistantId')==$obj->id)
		selected
	@endif 
	>{{$obj->englishName}}</option>
    @endforeach
  @endsection
 @section('location')
  @if(old('location'))
    value={{old('location')}}
    @endif
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
    	value="2"
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
                            <option value="6" @if(old('day')&&old('day')==6) selected @endif)>Friday</option>
                        </select>
 @endsection