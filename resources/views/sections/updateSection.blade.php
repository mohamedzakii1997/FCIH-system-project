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
    action="{{url('/sections/update/'.$section->id)}}"
@endsection

@section('location')
    @if(old('location'))
        value="{{old('location')}}"
        @else
value="{{$section->location}}"
@endif
@endsection

@section('duration')
@if(old('duration'))
        value="{{old('duration')}}"
        @else
value="{{$section->duration}}"
@endif
@endsection

@section('time')
@if(old('time'))
		value="{{old('time')}}"
		@else
value="{{$section->time}}"
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
                            <option value="6" @if(old('day')==6) selected @endif)>Friday</option>
        @else
        					<option value="0">Saturday</option>
                            <option value="1" @if($section->day==1) selected @endif)>Sunday</option>
                            <option value="2" @if($section->day==2) selected @endif)>Monday</option>
                            <option value="3" @if($section->day==3) selected @endif)>Tuesday</option>
                            <option value="4" @if($section->day==4) selected @endif)>Wednesday</option>
                            <option value="5" @if($section->day==5) selected @endif)>Thursday</option>
                            <option value="6" @if($section->day==6) selected @endif)>Friday</option>
        @endif
        </select>
 @endsection

  @section('assistantselect')
        @if(old('assistantId'))
            @foreach($assistants as $pro)
            <option value="{{$pro->id}}" @if($pro->id==old('assistantId')) selected @endif>{{$pro->englishName}}</option>
            @endforeach
        @else
            @foreach($assistants as $pro)
            <option value="{{$pro->id}}" @if($pro->id==$section->assistantId) selected @endif>{{$pro->englishName}}</option>
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
        <option value="{{$co->id}}" @if($co->id==$section->courseId) selected @endif>{{$co->courseCode}} | {{$co->englishName}}</option>
        @endforeach
    @endif
@endsection