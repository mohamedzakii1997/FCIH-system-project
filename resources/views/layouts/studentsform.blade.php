@extends('index')

@section('title')
  Students Dashboard
@endsection
@section('studentsActive')
  class="active"
@endsection
@section('content')
                    <div class="col-lg-6" style="margin: 0 auto;margin-top: 10px;">
                         <div class="card">
                            <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Student Form</h3>
                               </div>
                             <div class="card-body">
                            	<form class="form-horizontal" method="post" @yield('action')>
                                     {{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Name</label>
                                    <div class="col-sm-9">
                                    <input id="inputHorizontalSuccess" class="form-control form-control-success"
                                     type="text" name="englishName" @yield('e_namevalue') required maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">اسم</label>
                                    <div class="col-sm-9">
                                        <input id="inputHorizontalSuccess" class="form-control form-control-success" type="text" name="arabicName" @yield('a_namevalue') required maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Username</label>
                                    <div class="col-sm-9">
                                        <input id="inputHorizontalSuccess" class="form-control form-control-success"  type="text" name="username" @yield('usernamevalue') required maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input id="inputHorizontalSuccess" class="form-control form-control-success" type="password" name="password" @yield('requirePassword') >
                                    </div>
                                    
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input id="inputHorizontalSuccess" class="form-control form-control-success" type="text" name="email" @yield('emailvalue') required maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">SSN</label>
                                     <div class="col-sm-9">
                                        <input id="inputHorizontalSuccess" class="form-control form-control-success" class="form-control" type="number" name="SSN" @yield('ssnvalue') required maxlength="20">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Gender</label>
                                     <div class="col-sm-9">
                                        <input class="radio-template"  type="radio" name="gender" value="Male" @yield('malevalue') required> Male
                                        <input class="radio-template" type="radio" name="gender" value="Female" @yield('femalevalue') required> Female
                                    </div>
                                </div>
                                @yield('mainDepartmentId')
                                <input type="submit" name="save" value="save" class="btn btn-primary" >
                                </form>
                            </div>
                        </div>
                    </div>


@endsection