
@extends('index')
@section('title')
   Setting Dashboard
@endsection
@section('dashboardActive')
	class="active"
@endsection

@section('extrastyle')
	<style type="text/css">
		input[type='checkbox']{
			margin: 5px 30px 0px 20px
		}
	</style>
@endsection

@section('content')
<div class="container" style="margin-top: 20px">
	<form action="{{url('admin/setting')}}" method="post">
		{{csrf_field()}}
		<div class="form-group row">
			<input type="checkbox" name="1" class="radio-template" @if($settings[0]->status) checked  @endif>
			<label class="col-sm-11">Block Courses Registration</label>
		</div>

		<hr>

		<div class="form-group row">
			<input type="checkbox" name="2" class="radio-template" @if($settings[1]->status) checked  @endif>
			<label class="col-sm-11">Block Table</label>
		</div>

		<hr>

		<div class="form-group row">
			<input type="checkbox" name="3" class="radio-template" @if($settings[2]->status) checked  @endif>
			<label class="col-sm-11">Block Exceptional Requests</label>
		</div>

		<hr>

		<div class="form-group row">
			<input type="checkbox" name="4" class="radio-template" @if($settings[3]->status) checked  @endif>
			<label class="col-sm-11">Block My Courses</label>
		</div>

		<hr>

		<div class="form-group row">
			<input type="checkbox" name="5" class="radio-template" @if($settings[4]->status) checked  @endif>
			<label class="col-sm-11">Block Department Registration</label>
		</div>

		<hr>

		<div class="form-group row">
			<input type="checkbox" name="6" class="radio-template" @if($settings[5]->status) checked  @endif>
			<label class="col-sm-11">Block Transcript</label>
		</div>

		<div class="form-group" style="margin-top: 30px">
			<input type="submit" value="Save" class="btn btn-primary" >
		</div>
	</form>
</div>
@endsection