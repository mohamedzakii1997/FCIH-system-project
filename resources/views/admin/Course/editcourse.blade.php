@extends('layouts.courseForm')
@section('action')
    action="{{url('/admin/updatecourse/'.$course->id)}}"
@endsection
@section('e_namevalue')
    @if(old('englishName'))
        value={{old('englishName')}}
    @else
        value="{{$course->englishName}}"
    @endif
@endsection
@section('a_namevalue')
    @if(old('arabicName'))
        value={{old('arabicName')}}
    @else
        value="{{$course->arabicName}}"
    @endif
@endsection
@section('hoursvalue')
    @if(old('hours'))
        value={{old('hours')}}
    @else
        value="{{$course->hours}}"
    @endif
@endsection
@section('coursecodevalue')
    @if(old('courseCode'))
        value={{old('courseCode')}}
    @else
        value="{{$course->courseCode}}"
    @endif
@endsection
@section('totalgradevalue')
    @if(old('totalGrade'))
        value={{old('totalGrade')}}
    @else
        value="{{$course->totalGrade}}"
    @endif
@endsection

@section('finalgradevalue')
    @if(old('finalGrade'))
        value={{old('finalGrade')}}
    @else
        value="{{$course->finalGrade}}"
    @endif
@endsection

@section('midtermgradevalue')
    @if(old('midtermGrade'))
        value={{old('midtermGrade')}}
    @else
        value="{{$course->midtermGrade}}"
    @endif
@endsection

@if(old('available'))
    @section('availablevalue')
        checked
    @endsection
@elseif(old('available')==='0')
    @section('notavailablevalue')
        checked
    @endsection
@elseif($course->available)
    @section('availablevalue')
        checked
    @endsection
@else
    @section('notavailablevalue')
        checked
    @endsection
@endif

@if(old('category'))
    @section('mandatory')
        checked
    @endsection
@elseif(old('category')==='0')
    @section('optional')
        checked
    @endsection
@elseif($course->category)
    @section('mandatory')
        checked
    @endsection
@else
    @section('optional')
        checked
    @endsection
@endif

@section('courseid')
    @if(old('prerequisiteCourseId'))
        @for($i=0;$i<count($courses);$i++)
            @if($course->id==$courses[$i]->id)
                @continue
            @endif       
            <option value="{{$courses[$i]->id}}"
            @if(old('prerequisiteCourseId')==$courses[$i]->id)
                selected
            @endif
            > {{$courses[$i]->englishName }} | {{ $courses[$i]->courseCode }} </option>
        @endfor
    @else
        @for($i=0;$i<count($courses);$i++)
        @if($course->id==$courses[$i]->id)
            @continue
        @endif       
        <option value="{{$courses[$i]->id}}"
        @if($course->prerequisiteCourseId==$courses[$i]->id)
            selected
        @endif
        > {{$courses[$i]->englishName }} | {{ $courses[$i]->courseCode }} </option>
    @endfor
    @endif
@endsection

@section('departmentid')
    @if(old('departmentId'))
        @foreach($department as $dept)
            <option value="{{$dept->id}}"
            @if(old('departmentId')==$dept->id)
                selected
            @endif
            > {{$dept->name }} </option>
        @endforeach
    @else
        @foreach($department as $dept)
        <option value="{{$dept->id}}"
        @if($course->departmentId==$dept->id)
            selected
        @endif
        > {{$dept->name }} </option>
        @endforeach
    @endif
@endsection
