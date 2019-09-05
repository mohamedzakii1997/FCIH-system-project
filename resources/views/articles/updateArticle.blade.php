@extends('layouts.articleForm')
@section('action')
	action="{{url('/articles/update/'.$article->id)}}"
@endsection
@section('headerValue')
	@if(old('header'))
		value="{{ old('header')}}"
	@else
		value="{{ $article->header}}"
	@endif
@endsection

@section('descriptionValue')
@if(old('description'))
{{old('description')}}
@else
{{$article->description}}
@endif
@endsection