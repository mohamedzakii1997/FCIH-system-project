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
{{url('admin/lectures/update/').$lecture->id}}
@endsection


@section('profselect')
    @if(old('professorId'))
        @foreach($profs as $pro)
        <option value="{{$pro->id}}" @if($pro->id==old('professorId')) selected @endif>{{$pro->englishName}}</option>
        @endforeach
    @else
        @foreach($profs as $pro)
        <option value="{{$pro->id}}" @if($pro->id==$lecture->professorId) selected @endif>{{$pro->englishName}}</option>
        @endforeach
    @endif
@endsection

@section('courseselect')
@if(old('courseId'))
    @foreach($courses as $co)
    <option value="{{$co->id}}" @if($co->id==old('courseId')) selected @endif>{{$co->courseCode}} | {{$co->englishName}}</option>
    @endforeach
@else
    @foreach($courses as $co)
    <option value="{{$co->id}}" @if($co->id==$lecture->courseId) selected @endif>{{$co->courseCode}} | {{$co->englishName}}</option>
    @endforeach
@endif
@endsection

@section('location')
	@if(old('location'))
		value="{{old('location')}}"
		@else
value="{{$lecture->location}}"
@endif
@endsection

@section('duration')
@if(old('duration'))
		value="{{old('duration')}}"
		@else
value="{{$lecture->duration}}"
@endif
@endsection

@section('time')
@if(old('time'))
		value="{{old('time')}}"
		@else
value="{{$lecture->time}}"
@endif
@endsection

 @section('day')
    <select id="inputHorizontalSuccess" class="form-control form-control-success" name="day" required>
    	@if(old('day'))
                            <option value="0">Saturday</option>
                            <option value="1" @if(old('day')==1) selected @endif)>Sunday</option>
                            <option value="2" @if(old('day')==2) selected @endif)>Monday</option>
                            <option value="3" @if(old('day')==3) selected @endif)>Tuesday</option>
                            <option value="4" @if(old('day')==4) selected @endif)>Wednesday</option>
                            <option value="5" @if(old('day')==5) selected @endif)>Thursday</option>
        @else
        					<option value="0">Saturday</option>
                            <option value="1" @if($lecture->day==1) selected @endif)>Sunday</option>
                            <option value="2" @if($lecture->day==2) selected @endif)>Monday</option>
                            <option value="3" @if($lecture->day==3) selected @endif)>Tuesday</option>
                            <option value="4" @if($lecture->day==4) selected @endif)>Wednesday</option>
                            <option value="5" @if($lecture->day==5) selected @endif)>Thursday</option>
        @endif
        </select>
 @endsection