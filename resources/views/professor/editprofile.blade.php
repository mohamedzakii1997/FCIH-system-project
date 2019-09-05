@extends('editprofile')
@section('changeform')
action='{{url("professor/editprofile")}}'
@endsection

@section('image')
src="{{asset('storage/'.auth('professor')->user()->profilePicture)}}"
@endsection
@section('inputs')

<div class="form-group row">
    <label  class="col-md-4 control-label"><i class="fa fa-user" aria-hidden="true"></i> اسم</label>
    <div class="col-md-8">
        <input  type="text" class="form-control" name="name" value="{{auth(session()->get('guard'))->user()->arabicName}}"  readonly>
    </div>
</div>

 <div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-male" aria-hidden="true"></i> Gender</label>
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('professor')->user()->gender}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Salary</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('professor')->user()->salary}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-home" aria-hidden="true"></i> Department</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('professor')->user()->department->name}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-address-card" aria-hidden="true"></i> SSN</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('professor')->user()->SSN}}"  readonly>
</div>
</div>
@endsection