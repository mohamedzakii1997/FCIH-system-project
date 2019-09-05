@extends('index')

@section('content')
<div class="col-lg-6" style="margin: 0 auto;margin-top: 10px;">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="h4">Section Form</h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="post" @yield('action')>
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Course</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="courseId" required>
@yield('courseselect')
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Assistant</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="assistantId" required>
@yield('assistantselect')
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">location</label>
                    <div class="col-sm-9">
                        <input id="inputHorizontalSuccess" class="form-control form-control-success"  type="text" name="location" @yield('location') required maxlength="10">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Time</label>
                    <div class="col-sm-9">
                        <input id="inputHorizontalSuccess" class="form-control form-control-success" type="number" name="time" @yield('time') required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Day</label>
                    <div class="col-sm-9">
                        @yield('day')
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">duration</label>
                    <div class="col-sm-9">
                        <input id="inputHorizontalSuccess" class="form-control form-control-success" type="number" name="duration" @yield('duration') required>
                    </div>
                </div>
                <input type="submit" name="save" value="save" class="btn btn-primary" >
            </form>
        </div>
    </div>
</div>


@endsection