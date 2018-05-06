@include('control_panel.layouts.header')


<body class="hold-transition skin-black sidebar-mini fixed skin-red-light">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('frontend/assets/img/mini-logo.jpg') }}" style="height: 35px;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('frontend/assets/img/mini-logo.jpg') }}" style="height: 35px; margin: -5px 10px 0 -10px;"><b>St. John</b> Academy</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> --}}
                    <span class="hidden-xs">St. John Academy</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="http://via.placeholder.com/100x100" class="img-circle" alt="User Image">
                        <p>
                          <small>Administrador</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat js-view_profile">Profile</a>
                        </div>
                        <div class="pull-right">
                            {{-- <a href="#" class="btn btn-default btn-flat">Sign out</a> --}}
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                                class="btn btn-default btn-flat">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
              </li>
          </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        {{--  Admin Menu  --}}
        @if (Auth::user()->role == 1)
          <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-circle-o"></i> <span>Dashboard</span></a></li>
        @endif
        
        @if (Auth::user()->role == 1 || Auth::user()->role == 0)
          <li><a href="{{ route('admin.faculty_information') }}"><i class="fa fa-circle-o"></i> <span>Faculty Information</span></a></li>
          <li><a href="{{ route('admin.registrar_information') }}"><i class="fa fa-circle-o"></i> <span>Registrar Information</span></a></li>
          <li><a href="{{ route('admin.student.information') }}"><i class="fa fa-circle-o"></i> <span>Student Information</span></a></li>
        @endif
        {{--  Admin Menu End  --}}
        
        {{--  Registrar Menu  --}}
        @if (Auth::user()->role == 3)
          <li><a href="{{ route('registrar.dashboard') }}"><i class="fa fa-circle-o"></i> <span>Dashboard</span></a></li>
        @endif
        
        {{--  Faculty Menu  --}}
        @if (Auth::user()->role == 4)
          <li><a href="{{ route('faculty.dashboard') }}"><i class="fa fa-circle-o"></i> <span>Dashboard</span></a></li>
          <li><a href="{{ route('faculty.subject_class') }}"><i class="fa fa-circle-o"></i> <span>Subject Class</span></a></li>
          <li><a href="{{ route('faculty.class_schedules') }}"><i class="fa fa-circle-o"></i> <span>Class Schedules</span></a></li>
        @endif

        @if (Auth::user()->role == 3)
          <li><a href="{{ route('registrar.class_details') }}"><i class="fa fa-circle-o"></i> <span>Class Details</span></a></li>   
        @endif             
          {{--  Registrar Menu End  --}}
        @if (Auth::user()->role == 1 || Auth::user()->role == 0)
          <li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o"></i> 
                <span>Maintenance</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                  {{--  Admin Menu  --}}
                  <li><a href="{{ route('admin.maintenance.school_year') }}"><i class="fa fa-circle-o"></i> <span>School Year</span></a></li>
                  <li><a href="{{ route('admin.maintenance.subjects') }}"><i class="fa fa-circle-o"></i> <span>Subjects</span></a></li>
                  <li><a href="{{ route('admin.maintenance.classrooms') }}"><i class="fa fa-circle-o"></i> <span>Class Rooms</span></a></li>
                  <li><a href="{{ route('admin.maintenance.section_details') }}"><i class="fa fa-circle-o"></i> <span>Section Details</span></a></li>
                  {{--  Admin Menu End  --}}
                  
              </ul>
          </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('content_title')
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
          <div class="col-sm-12">
          <div class="row">
              <div class="col-sm-12">
                  <div class="js-messages_holder" style="display:none"></div>
              </div>
          </div>
            @yield('content')
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@include('control_panel.layouts.footer')