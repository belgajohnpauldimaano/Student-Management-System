@include('control_panel.layouts.header')

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
<div class="wrapper">

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-danger">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars text-lg"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link text-lg" style="margin-top: -5px">School Year: {{ $SchoolYear->school_year }}</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          @include('control_panel.layouts.notification')
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt text-lg"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img style="width: 30px; margin-top: -5px;"
               src="{{ Auth::user()->get_user_data()->photo_profile }}" class="img-circle elevation-2" alt="User Image"
            >
            <span class="hidden-xs">{{ \Auth::user()->get_user_data()->full_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="text-center">
                  <img width="70" src="{{ Auth::user()->get_user_data()->photo_profile }}" class="img-circle img-circle elevation-2" alt="User Image"
                  >
                  <br/>
                  <p>
                    <span class="hidden-xs">{{ \Auth::user()->get_user_data()->full_name }}</span><br/>
                    <small>{{ \Auth::user()->get_user_role_display() }}</small>
                  </p>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('student.my_account.index') }}">
              {{-- <i class="fa fa-user nav-icon"></i> --}}
              <i class="fa fa-user mr-2"></i> My Profile
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
  <aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="/" class="brand-link navbar-danger">
      <img src="{{ asset('/img/sja-logo.png') }}"  class="brand-image img-circle elevation-3" style="height: 35px; opacity: .8">
      <span class="brand-text font-weight-bold text-white">ST. JOHN'S ACADEMY INC.</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sm form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sm btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

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
            <a class="{{request()->routeIs('student.student_appointment') ? 'active' : '' }} nav-link" href="{{ route('student.student_appointment') }}">
              <i class="far fa-calendar-check nav-icon"></i></i> <p>Appointment for Walk in</p></a>
          </li> 
          <li class="nav-item">
            <a class="{{request()->routeIs('student.class_schedule.index') ? 'active' : '' }} nav-link" href="{{ route('student.class_schedule.index') }}">
              <i class="fa fa-calendar nav-icon"></i> <p>Class Schedule</p>
            </a>
          </li>
          <li class=" nav-item">
            <a class="nav-link {{request()->routeIs('student.grade_sheet.index') ? 'active' : '' }}" href="{{ route('student.grade_sheet.index') }}">
              <i class="fas fa-file-alt nav-icon""></i> <p>Grade Sheet</p></a>
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
            <a class="{{request()->routeIs('student.assessment.index') ? 'active' : '' }} nav-link" href="{{ route('student.assessment.index') }}">
              <i class="fas fa-edit nav-icon"></i> <p>Assessment</p></a>
            </a>
          </li>

          {{-- <li class="nav-header">PROFILE</li>
          <li class="nav-item">
            <a class="{{request()->routeIs('student.my_account.index') ? 'active' : '' }} nav-link" href="{{ route('student.my_account.index') }}">
              <i class="fa fa-user nav-icon"></i> <p>My Profile</p>
            </a>
          </li> --}}
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