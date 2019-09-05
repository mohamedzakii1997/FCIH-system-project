@extends('index')
@section('content')
	<div class="container" style="background-color: #fff; padding: 30px;margin-top:50px">
		<form method="post" @yield('action')>
			{{csrf_field()}}
			<div class="form-group">
				<label>Header</label>
				<input type="text" name="header" class="form-control" required maxlength="100" @yield('headerValue')>
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control" style="height: 100px" required>@yield('descriptionValue')</textarea>
			</div>
			<input type="submit" name="submit" value="Save" class="btn btn-primary" style="margin-top: 100px;margin-bottom: 10px">
		</form>
	</div>
@endsection