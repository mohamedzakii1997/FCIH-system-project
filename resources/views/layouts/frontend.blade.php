<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>@yield('title')</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="{{Request::root()}}/assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{Request::root()}}/assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('assets/css/main.css')}}"/>
		<link rel="stylesheet" href="{{Request::root()}}/assets/sweetalert.css">
		<style type="text/css">
			.dropdown-menu{
    min-width: 200px;
    margin-bottom: 0;
    padding: 15px 0;
    max-width: 400px;
    border: none;
    top:10px !important;
			}
			.dropdown-item{
				    background: #fff;
    color: #777;
    width: 100%;
    padding: 2px 12px
			}
			.dropdownMenuLink{
    color: #fff;
    position:relative;
			}
	.bg-red{
		    position: absolute;top:-8px;right: -6px;font-weight: 400;font-size: 0.7em;width: 18px;height: 18px;line-height: 22px;text-align: center;padding: 0;border-radius: 50%;background: #ff7676 !important;color: #fff;-webkit-transition: all 0.3s;
	}
	.dropdown{
		margin-right: 10px
	}
	.sweet-alert{
		max-width: 700px !important;
		width:auto !important;
	}
	#header{
		position: static
	}
	.container{
		margin-top: 30px
	}
	.dropdown-menu{
		box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1), -2px 0 2px rgba(0, 0, 0, 0.1)
	}

	.sweet-alert{
		min-width: 500px
	}
	.fit img {
		 height: 320px
	}
	.deplist{
		margin: 0;
		width:100%;
		list-style: none;
		display: block;
		overflow: hidden;
		margin-bottom: 120px
	}
	.deplist li{
		text-align: center;
		display: inline-block;
		float: left;
		width: 33%;
	}
	.deplist li a{
		display: block;
		border-radius: 20px;
		padding: 10px;
		background-color: #a4b0be;
		color: #fff;
		transition: background-color 1s ease 0s;
		font-size: 22px
	}
	.deplist li a:hover{
		background-color: #747d8c
	}
	.breadcrumb-container {
		border-radius:20px;
		background-color: #f1f2f6;
		margin-bottom: 80px
	}
		.breadcrumb-item a{
	color:#747d8c !important
}

.breadcrumb-item a:hover{
	text-decoration:underline
}
.breadcrumb-item{
	color:#000 !important;
	font-weight:bold
}


	@yield('extraStyle')

		</style>
	</head>
	<body>
					<header id="header" @yield('alt') style="overflow: visible;">
					<div class="logo"><a href="{{url('home')}}">FCIH</a></div>
							@if(auth('web')->check())
										@php 
								$user=auth('web')->user();
										@endphp

										@elseif(auth('assistant')->check())
										@php 
								$user=auth('assistant')->user(); 
										@endphp
								        
								        @elseif(auth('professor')->check())
								        @php 
								$user=auth('professor')->user(); 
										@endphp	
										@else
										@php 
								$user='';
										@endphp	
										
										@endif
					{{-- Start Notification --}}
		@if($user instanceof App\RegularUser)
					<div class="dropdown show" style="display: inline">
  <a id="dropdownMenuLink" role="button" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-togglek" onclick="updatenotification()"><i class="fa fa-bell-o" style="font-size:1.2rem;color:#fff !important"></i>
@if(count($user->unreadNotifications))
  	<span class="badge bg-red" id="notificationsnumber">{{count($user->unreadNotifications)}} </span>
  @else
<span class="badge bg-red" id="notificationsnumber" style="visibility: none;"></span>
  @endif
</a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="shownotifications">
    @foreach($user->Notifications()->take(5)->get() as $notifi)
   <a class="dropdown-item" href="#">{{$notifi->data['header']}}</a>
   @endforeach
  </div>
</div>
		@endif
					{{-- End Notification --}}
					@if(session()->exists('guard'))
	                    <a href="{{ route('logout') }}"
	                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	                       <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
	                    </a>
	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        {{ csrf_field() }}
	                    </form>
	                @else
	                	<a href="{{url('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
					@endif
					<a href="#menu">Menu</a>
			</header>
			
			@if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif
        @if($errors->any())
            @include('layouts.errors')
        @endif

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					@if(auth('admin')->check())
						<li><a href="{{url('admin/dashboard')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Admin Panel</a></li>
						<li><a href="{{url('admin/editprofile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
						<li><a href="{{url('admin/editpassword')}}"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a></li>
					@endif
					@if(auth('web')->check())
						<li><a href="{{url('student/editprofile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
						<li><a href="{{url('student/editpassword')}}"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a></li>
						<li><a href="{{url('student/account')}}"><i class="fa fa-window-maximize" aria-hidden="true"></i> My Account</a></li>
					@endif
					@if(auth('professor')->check())
						<li><a href="{{url('professor/editprofile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
						<li><a href="{{url('professor/editpassword')}}"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a></li>
						<li><a href="{{url('professor/all')}}"><i class="fa fa-briefcase" aria-hidden="true"></i> My Courses</a></li>
						<li><a href="{{url('professor/showmycourses')}}"><i class="fa fa-table" aria-hidden="true"></i> My Table</a></li>
					@endif
					@if(auth('assistant')->check())
						<li><a href="{{url('assistant/editprofile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
						<li><a href="{{url('assistant/editpassword')}}"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a></li>
						<li><a href="{{url('assistant/all')}}"><i class="fa fa-briefcase" aria-hidden="true"></i> My Courses</a></li>
						<li><a href="{{url('assistant/showmysections')}}"><i class="fa fa-table" aria-hidden="true"></i> My Table</a></li>
					@endif
					<li><a href="{{url('articles/all')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Articles</a></li>
					<li><a href="{{url('informationsecuritylab')}}"><i class="fa fa-shield" aria-hidden="true"></i> Information Security Lab</a></li>
					<li><a href="{{url('researchplan')}}"><i class="fa fa-flask" aria-hidden="true"></i> Research Plan</a></li>
					<li><a href="{{url('departments/overview')}}"><i class="fa fa-university" aria-hidden="true"></i> Departments</a></li>
				</ul>
			</nav>
		@yield('content')
			<script src="{{asset('assets/js/jquery.min.js')}}"></script>
			<script src="{{asset('assets/js/jquery.scrollex.min.js')}}"></script>
			<script src="{{asset('assets/js/skel.min.js')}}"></script>
			<script src="{{asset('assets/js/util.js')}}"></script>
			<script src="{{asset('assets/js/main1.js')}}"></script>
			<script src="{{Request::root()}}/assets/vendor/popper.js/umd/popper.min.js"> </script>
   			<script src="{{Request::root()}}/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
   			
	@if(auth('web')->check())
		<script type="text/javascript">
			function getpath(){
				var arr=[];
            arr[0]="{{url('/student/getnotifications')}}";
            arr[1]="{{url('/student/updatemynotification?action=update')}}";
				return arr;}
		</script>

		@elseif(auth('assistant')->check())
		<script type="text/javascript">
			function getpath(){
				var arr=[];
            arr[0]="{{url('/assistant/getnotifications')}}";
            arr[1]="{{url('/assistant/updatemynotification?action=update')}}";
				return arr;}
		</script>        
        @elseif(auth('professor')->check())
        		<script type="text/javascript">
			function getpath(){
				var arr=[];
            arr[0]="{{url('/professor/getnotifications')}}";
            arr[1]="{{url('/professor/updatemynotification?action=update')}}";
				return arr;}
		</script>
		@endif

	@if($user instanceof App\RegularUser)

	<script type="text/javascript">

function getid(){

var http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         var arr= JSON.parse(this.responseText);
      document.getElementById("shownotifications").innerHTML = arr[0];
      if(arr[1]!=0){
       document.getElementById("notificationsnumber").innerHTML=arr[1];
document.getElementById("notificationsnumber").style.visibility="visible";
   }
       else { document.getElementById("notificationsnumber").style.visibility="hidden";}
    }
  };  
var path =getpath();
  http.open("GET",path[0],true);
  http.send();
}

function updatenotification()
{ 
	document.getElementById("notificationsnumber").style.visibility="hidden";
var path=getpath();
var http = new XMLHttpRequest();
 http.open("GET",path[1],true);
  http.send();
}

function JSalert(message){
  swal(message);
}
setInterval(getid,3000);

</script> 
  <script src="{{Request::root()}}/assets/sweetalert-dev.js"></script>
@endif


	</body>
</html>