@extends('layouts.frontend')
@section('title')
Edit Profile
@endsection

@section('extraStyle')
    .form-group{
    margin-bottom:20px
}
.control-label{
    margin-top:10px
}
.image:hover{
    background-color:#333 !important
}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-between">
    <div  class="col-sm-3">
        <img  @yield('image') style="display:block;width:200px; height:200px; border-radius:50%; margin-right:25px; border: 1px solid #000; line-height:200px; text-align: center " alt="None">
        <button class="btn image" id="image" style="display: block;width: 200px;color:#fff !important; background-color: #000;margin-top: 20px"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Uplod Profile Image</button>
    </div>
<div class="col-sm-7">
             <div class="card">
                <div class="card-header d-flex align-items-center">
                <h3 class="h4">Edit Profile</h3>
                   </div>
                 <div class="card-body">
                    <form class="form-horizontal" method="POST" @yield('changeform') enctype="multipart/form-data">
                        {{ csrf_field() }}
                         <input type="file" id="file" name="file" hidden>
                        <div class="form-group row">
                            <label  class="col-md-4 control-label"><i class="fa fa-user" aria-hidden="true"></i> Name</label>
                            <div class="col-md-8">
                                <input  type="text" class="form-control" name="name" value="{{auth(session()->get('guard'))->user()->englishName}}"  readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 control-label"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
                            <div class="col-md-8">
                                <input  type="email" class="form-control" name="email" value="{{auth(session()->get('guard'))->user()->email}}"  required>
                            </div>
                        </div>
 
                        
                        @yield('inputs')

                        <div class="form-group" style="margin-top: 45px">
                                <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <script type="text/javascript">
            document.getElementById('image').onclick=function(){
                document.getElementById('file').click();
            };
        </script>
@endsection
