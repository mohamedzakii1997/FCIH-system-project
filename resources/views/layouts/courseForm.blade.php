@extends('index')
@section('title')
  Courses Dashboard
@endsection
@section('coursesActive')
  class="active"
@endsection
@section('content')
    <div class="col-lg-6" style="margin: 0 auto;margin-top: 10px;">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Course Form</h3>
            </div>
            <div class="card-body">
                <form method="post" @yield('action')>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class=" form-control-label"> Name</label>
                        <div class="input-group">
                        <input class="form-control" type="text" name="englishName" @yield('e_namevalue') required maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">اسم</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="arabicName" @yield('a_namevalue') required maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Course Code</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="courseCode" @yield('coursecodevalue') required maxlength="8">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Hours</label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="hours" @yield('hoursvalue') required maxlength="2">
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Total Grade</label>
                        <div class="input-group">
                            <input class="form-control" type="number"  name="totalGrade" @yield('totalgradevalue') required maxlength="3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Final Grade</label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="finalGrade" @yield('finalgradevalue') required maxlength="3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Midterm Grade</label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="midtermGrade" @yield('midtermgradevalue') required maxlength="2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Status</label>
                        <div class="col-sm-9">
                            <input  type="radio" name="available" class="radio-template" value="1" @yield('availablevalue') required > Available
                            <input  type="radio" name="available" class="radio-template" value="0" @yield('notavailablevalue') required  style="margin-left: 20px"> Not Available
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Category</label>
                        <div class="col-sm-9">
                            <input  type="radio" name="category" class="radio-template" value="1" @yield('mandatory') required > Mandatory
                            <input  type="radio" name="category" class="radio-template" value="0" @yield('optional') required style="margin-left: 20px"> Optional
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Deparment</label>
                        <div class="input-group">
                        <select class="selectpicker" name='departmentId' style="padding:5px 10px" required>
                            @yield('departmentid')
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Prerequisite Course</label>
                        <div class="input-group">
                        <select class="selectpicker" name='prerequisiteCourseId' style="padding:5px 10px">
                        <option value="" > None</option>
                        @yield('courseid')
                        </select>
                        </div>
                    </div>
                    <input type="submit" name="save" value="save" class="btn btn-primary" >
                </form>
            </div>
        </div>
    </div>

@endsection