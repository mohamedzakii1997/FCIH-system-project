@extends('layouts.frontend')
@section('title')
Edit Password
@endsection

@section('extraStyle')
    .form-group{
    margin-bottom:20px
}
.form-control-label{
    margin-top:10px
}
@endsection

@section('content')

<div class="col-lg-7" style="margin: 0 auto;margin-top: 10px;">
             <div class="card">
                <div class="card-header d-flex align-items-center">
                <h3 class="h4">Change Password</h3>
                   </div>
                 <div class="card-body">
                    <form class="form-horizontal" method="post" @yield('changeform')">
                         {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label"> Current Password</label>
                        <div class="col-sm-9">
                            <input id="current-password" type="password" class="form-control" name="current-password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label"> New Password</label>
                        <div class="col-sm-9">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Confirm New Password</label>
                        <div class="col-sm-9">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                    </div>
                    <input type="submit" name="save" value="Change" class="btn btn-primary" >
                    </form>
                </div>
            </div>
        </div>
@endsection
