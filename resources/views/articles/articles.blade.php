@extends('layouts.frontend')
@section('title')
	Articles
@endsection
@section('content')
	<div class="container">
		@if(auth('professor')->check())
			<a href="{{url('articles/add')}}" class="btn btn-primary" style="margin-bottom: 10px"><i class="fa fa-plus" aria-hidden="true"></i> Add New One</a>
		@endif
		<table class="table table-bordered">
			 <thead >
			    <tr>
				    <th scope="col">Header</th>
				    <th scope="col">Professor Name</th>
				    <th scope="col">Options</th>
			    </tr>
			 </thead>
			 <tbody>
			 	@foreach($articles as $article)
			 		<tr>
				      	<td>{{$article->header}}</td>
				      	<td>{{$article->professor->englishName}}</td>
				      	<td><a href="{{url('/articles/'.$article->id)}}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
					      	@if(auth('professor')->check())
								<a href="{{url('articles/update/'.$article->id)}}" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Update</a>
						  	@endif
						  	@if(auth('admin')->check())
								<a href="{{url('articles/delete/'.$article->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Article')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
						  	@endif
					  	</td>
			    	</tr>
				@endforeach
			 </tbody>
		</table>
	</div>
@endsection