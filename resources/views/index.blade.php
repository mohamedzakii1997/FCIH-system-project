<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{Request::root()}}/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{Request::root()}}/assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{Request::root()}}/assets/css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{Request::root()}}/assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{Request::root()}}/assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{Request::root()}}/assets/img/favicon.ico">
    <style type="text/css">
      th:hover{
        cursor: pointer
      }
    </style>
    @yield('extrastyle')
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="{{url('admin/dashboard')}}" class="navbar-brand">
                  <div class="brand-text brand-big"><strong>FCIH Dashboard</strong></div>
                  <div class="brand-text brand-small"><strong>FD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o" onclick="updatenotifi()"></i>
                @if(count(auth('admin')->user()->unreadNotifications))
                  <span class="badge bg-red" id="notificatoinnumbers">{{count(auth('admin')->user()->unreadNotifications)}}</span>
                 @endif
                </a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    @foreach(auth('admin')->user()->Notifications()->take(10)->get() as $notific)
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification" style="overflow: hidden;">
                          <div class="notification-content"><i class="fa fa-envelope bg-green"></i>{{$notific->data['studentName']}} send a request because {{$notific->data['reason']}} </div>
                        </div></a></li>
                    @endforeach

    
                    <li><a rel="nofollow" href="{{url('admin/exceptionalRequests')}}" class="dropdown-item all-notifications text-center"> <strong>view all Requests</strong></a></li>
                  </ul>
                </li>
                <!-- Logout    -->
                <li class="nav-item"><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav nav-link logout">
                                            Logout <i class="fa fa-sign-out"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
              </ul>
            </div>
          </div>
        </nav>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif
        @if($errors->any())
            @include('layouts.errors')
        @endif
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar" style="overflow: hidden"><img src="{{asset('storage/'.auth('admin')->user()->profilePicture)}}" alt="..." class="img-fluid rounded-circle" style="width:100%;height: 100%"></div>
            <div class="title">
              <h1 class="h4">{{ strtoupper(auth('admin')->user()->englishName)}}</h1>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
                    <li @yield('dashboardActive')><a href="{{url('/admin/dashboard')}} "> <i class="fa fa-window-restore" aria-hidden="true"></i> Dashboard</a></li>
                    <li><a href="{{url('/home')}} "> <i class="icon-home"></i>Home</a></li>
                    <li @yield('studentsActive')><a href="{{url('admin/students/all')}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Students </a></li>
                    <li @yield('coursesActive')><a href="{{url('admin/courses')}}"><i class="fa fa-book" aria-hidden="true"></i> Courses</a></li>
                    <li @yield('teachersActive')><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"><i class="fa fa-users" aria-hidden="true"></i> Teachers </a>
                      <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                         <li @yield('professorsActive')><a href="{{url('admin/professors/all')}}"><i class="fa fa-user" aria-hidden="true"></i> Professors</a></li>
                         <li @yield('assistantsActive')><a href="{{url('/assistants/all')}}"><i class="fa fa-user" aria-hidden="true"></i> Assistants</a></li>
                      </ul>
                    </li>
                    <li @yield('tablesActive')><a href="#tabledropdown" aria-expanded="false" data-toggle="collapse"><i class="fa fa-table" aria-hidden="true"></i> Tables </a>
                      <ul id="tabledropdown" class="collapse list-unstyled ">
                         <li @yield('lecturesTableActive')><a href="{{url('admin/showoveralltable')}}"><i class="fa fa-table" aria-hidden="true"></i> Lectures</a></li>
                         <li @yield('sectionsTableActive')><a href="{{url('admin/showoverallsections')}}"><i class="fa fa-table" aria-hidden="true"></i> Sections</a></li>
                      </ul>
                    </li>
                    <li @yield('appointmentActive')><a href="#appointment" aria-expanded="false" data-toggle="collapse"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Appointments</a>
                      <ul id="appointment" class="collapse list-unstyled ">
                         <li @yield('lecturesActive')><a href="{{url('admin/lectures/all')}}"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Lectures</a></li>
                         <li @yield('sectionsActive')><a href="{{url('/sections/all')}}"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Sections</a></li>
                      </ul>
                    </li>
          </ul><span class="heading">Extras</span>
          <ul class="list-unstyled">
            <li @yield('departmentsActive')><a href="{{url('admin/departments')}}"><i class="fa fa-university" aria-hidden="true"></i> Departments </a></li>
            <li> <a href="{{url('/articles/all')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Articles </a></li>
            <li @yield('exceptional')> <a href="{{url('/admin/exceptionalRequests')}}"><i class="fa fa-commenting" aria-hidden="true"></i> Exceptional Requests </a></li>
          </ul>
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom" style="font-size: 40px; font-weight: normal;color: #796AEE">Admin Panel</h2>
            </div>
          </header>
         
         
<!-- my forms -->
  @yield('content')  



    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{Request::root()}}/assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="{{Request::root()}}/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{Request::root()}}/assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{{Request::root()}}/assets/vendor/chart.js/Chart.min.js"></script>
    <script src="{{Request::root()}}/assets/js/charts-home.js"></script>
    <script type="text/javascript">
      function updatenotifi() {
        document.getElementById('notificatoinnumbers').innerHTML='';
        var http = new XMLHttpRequest();

    http.open("GET","{{url('/admin/updatemynotific')}}",true);
    http.send();
      }
    </script>
    <!-- Main File-->
    <script src="{{Request::root()}}/assets/js/front.js"></script>
    @yield('extrascripts')
  </body>
</html>