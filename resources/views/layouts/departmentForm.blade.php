@extends('index')
@section('title')
  Departments Dashboard
@endsection
@section('departmentsActive')
  class="active"
@endsection

@section('content')
                    <div class="col-lg-6" style="margin: 0 auto;margin-top: 10px;">
                         <div class="card">
                            <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Department Form</h3>
                               </div>
                             <div class="card-body">
                            	<form class="form-horizontal" method="post" @yield('action')>
                                     {{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Name</label>
                                    <div class="col-sm-9">
                                    <input id="inputHorizontalSuccess" class="form-control form-control-success"
                                     type="text" name="name" @yield('namevalue') required maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Symbol</label>
                                    <div class="col-sm-9">
                                        <input id="inputHorizontalSuccess" class="form-control form-control-success" type="text" name="symbol" @yield('symbolvalue') required maxlength="4">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Optional Hours</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-success" type="number" name="optional" @yield('optional') required>
                                    </div>
                                </div>
                                <input type="submit" name="save" value="save" class="btn btn-primary" >
                                </form>
                            </div>
                        </div>
                    </div>
@endsection