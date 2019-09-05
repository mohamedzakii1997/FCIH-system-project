@extends('editprofile')
@section('changeform')
action='{{url("student/editprofile")}}'
@endsection

@section('image')
src="{{asset('storage/'.auth('web')->user()->profilePicture)}}"
@endsection

@section('inputs')

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-id-card" aria-hidden="true"></i> ID</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->id}}"  readonly>
</div>
</div>

 <div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-male" aria-hidden="true"></i> Gender</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->gender}}"  readonly>
</div>
</div>


<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-address-card" aria-hidden="true"></i> SSN</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->SSN}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-level-up" aria-hidden="true"></i> Level</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->level}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Hours</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->hours}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> GPA</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->GPA}}"  readonly>
</div>
</div>

<div class="form-group row">
<label  class="col-md-4 control-label"><i class="fa fa-home" aria-hidden="true"></i> Department</label>
 
 <div class="col-md-8">
 <input  type="text" class="form-control"  value="{{auth('web')->user()->department->name}}"  readonly>
</div>
</div>
@endsection