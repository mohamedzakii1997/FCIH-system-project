@extends('layouts.frontend')
@section('title')
	{{$article->header}}
@endsection
@section('content')
	<div class="container" style="background-color: #fff">
		<h1 style="text-align: center;font-weight: bold">{{$article->header}}</h1>
		<hr>
		<div style="padding:20px 20px 90px; min-height: 320px">
			{{$article->description}}
		</div>
		<hr>
		<span>Author: Dr.{{$article->professor->englishName}}</span>
	</div>
@endsection