@include('control_panel.layouts.header')

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
<div class="wrapper">

  <!-- Header Navbar: style can be found in header.less -->
    <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-danger">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">School Year: {{ $SchoolYear->school_year }}</a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> --}}
      </ul>
      <!-- Sidebar toggle button-->
      {{-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> --}}
      <!-- Navbar Right Menu -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
            <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
            <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img style="width: 30px; margin-top: -5px;"
               src="{{ \Auth::user()->get_user_data()->photo ? 
                \File::exists(public_path('/img/account/photo/'. 
                \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. 
                \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : 
                asset('/img/account/photo/blank-user.gif') }}" class="img-circle elevation-2" alt="User Image"
            >
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="text-center">
                  <img width="70" src="{{ \Auth::user()->get_user_data()->photo ? 
                  \File::exists(public_path('/img/account/photo/'. 
                  \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. 
                  \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : 
                  asset('/img/account/photo/blank-user.gif') }}" class="img-circle elevation-2" alt="User Image"
                  >
                  <br/>
                  <p>
                    <small>{{ \Auth::user()->get_user_role_display() }}</small>
                  </p>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <div class="p-2">
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                  class="btn btn-primary btn-block">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
          </div>
        </li>
      </ul>
      </nav>
  {{-- </header> --}}
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar elevation-4 sidebar-dark-danger">
    <!-- Brand Logo -->
    <a href="/" class="brand-link navbar-danger">
      <img src="{{ asset('/img/sja-logo.png') }}"  class="brand-image img-circle elevation-3" style="height: 35px; opacity: .8">
      <span class="brand-text font-weight-light"<b>St. John's Academy Inc</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="padding: 0px 4px;">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">STUDENT NAVIGATION</li>
          
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
              <i class="fa fa-home fa-fw nav-icon"></i> <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('student.enrollment.index') ? 'active' : '' }}" href="{{ route('student.enrollment.index') }}">
              <i class="fas fa-file nav-icon"></i> <p>Payment Registration</p>
            </a>
          </li> 
          <li class="nav-item">
            <a class="{{request()->routeIs('student.student_appointment') ? 'active' : '' }} nav-link" href="{{ route('student.student_appointment') }}"><i class="far fa-calendar-check nav-icon"></i></i> <p>Appointment for Walk in</p></a>
          </li> 
          <li class="nav-item">
            <a class="{{request()->routeIs('student.class_schedule.index') ? 'active' : '' }} nav-link" href="{{ route('student.class_schedule.index') }}"><i class="fa fa-calendar nav-icon"></i> <p>Class Schedule</p></a>
          </li>
          <li class=" nav-item">
            <a class="nav-link {{request()->routeIs('student.grade_sheet.index') ? 'active' : '' }}" href="{{ route('student.grade_sheet.index') }}"><i class="fa fa-file-text-o nav-icon"></i> <p>Grade Sheet</p></a>
          </li>
          
          <li class="nav-header">CAMPUS LMS</li>
          <li class="nav-item">
            <a class="nav-link" href=""><i class="fas fa-file nav-icon"></i> <p>Current Lesson</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=""><i class="far fa-copy nav-icon"></i> <p>Upcoming Lesson</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=""><i class="fas fa-file-archive nav-icon"></i> <p>Past Lesson</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=""><i class="far fa-file nav-icon"></i> <p>Assignment</p></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=""><i class="fas fa-edit nav-icon"></i> <p>Assessment</p></a>
          </li>

          <li class="nav-header">PROFILE</li>
          <li class="nav-item">
            <a class="{{request()->routeIs('student.my_account.index') ? 'active' : '' }} nav-link" href="{{ route('student.my_account.index') }}"><i class="fa fa-user nav-icon"></i> <p>My Profile</p></a>
          </li>
        </ul>
      </nav>
    </div>    
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('content_title')
      </h1>
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