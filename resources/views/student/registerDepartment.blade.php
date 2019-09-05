@extends('layouts.frontend')
@section('title')
	 Department Registrations
@endsection
@section('extraStyle')
	.form-group{
	margin-bottom:20px
}
@endsection

@section('content')
        <div class="col-lg-6" style="margin: 0 auto;margin-top: 10px;">
             <div class="card">
                <div class="card-header d-flex align-items-center">
                <h3 class="h4">Departments </h3> <small style="margin-left: 10px; color: #f00">(Remember That You Can't Change Your Department Later)</small>
                   </div>
                 <div class="card-body"> 
                	<form class="form-horizontal" method="post" action="{{url('student/registerDepartment')}}">
                         {{ csrf_field() }}
                    <div class="form-group row">
	                    <label class="col-sm-3 form-control-label">Department</label>
	                    <div class="col-sm-9">
	                        <select class="form-control" name="departmentId" required>
	                        	@foreach($departments as $department)
	                        		<option value="{{$department->id}}">{{$department->name}}</option>
	                        	@endforeach
	                        </select>
	                    </div>
	                </div>
                    <input type="submit" name="save" value="save" class="btn btn-primary" onclick="return confirm('Are You Sure You Want To Register This Department')">
                    </form>
                </div>
            </div>
        </div>
@endsection