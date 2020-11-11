@include('control_panel.layouts.header')


<body class="hold-transition skin-black sidebar-mini fixed skin-red-light">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      {{-- <span class="logo-mini"><img src="{{ asset('frontend/assets/img/mini-logo.jpg') }}" style="height: 35px;"></span> --}}
      <span class="logo-mini"><img src="{{ asset('/img/sja-logo.png') }}" style="height: 35px;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        {{-- <img src="{{ asset('/img/sja-logo.png') }}" style="height: 35px; margin: -5px 10px 0 -10px;"> <br/> --}}
      <b>St. John's</b> Academy Inc.</span>
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
                    <img src="{{ \Auth::user()->get_user_data()->photo ? \File::exists(public_path('/img/account/photo/'. \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ \Auth::user()->get_user_data()->first_name . ' ' . \Auth::user()->get_user_data()->last_name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{ \Auth::user()->get_user_data()->photo ? \File::exists(public_path('/img/account/photo/'. \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" class="img-circle" alt="User Image">
                        <p>
                          <small>{{ \Auth::user()->get_user_role_display() }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        {{--  <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat js-view_profile">Profile</a>
                        </div>  --}}
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
        @if (Auth::user()->role == 1 || Auth::user()->role == 0)
          <li class="{{request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="fa  fa-home fa-fw fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Dashboard</span></a>
          </li>
          <li class="{{request()->routeIs('shared.faculty_class_schedules.index') ? 'active' : '' }}">
            <a href="{{ route('shared.faculty_class_schedules.index') }}"><i class="fa  fa-file-text-o fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Class Schedule</span></a>
          </li>
          <li class="{{request()->routeIs('admin.admission_information') ? 'active' : '' }}">
            <a href="{{ route('admin.admission_information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Admission Information</span></a>
          </li>
          <li class="{{request()->routeIs('admin.faculty_information') ? 'active' : '' }}">
            <a href="{{ route('admin.faculty_information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Information</span></a>
          </li>
          <li class="{{request()->routeIs('admin.registrar_information') ? 'active' : '' }}">
            <a href="{{ route('admin.registrar_information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Registrar Information</span></a>
          </li>
          <li class="{{request()->routeIs('admin.finance_information') ? 'active' : '' }}">
            <a href="{{ route('admin.finance_information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Finance Information</span></a>
          </li>
          <li class="{{request()->routeIs('admin.student.information') ? 'active' : '' }}">
            <a href="{{ route('admin.student.information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Information</span></a>
          </li>
          
          <li >
            <a href="#"><i class="fas fa-users fa-lg"></i>
              &nbsp;&nbsp;&nbsp; 
              <span>Incoming Student</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              {{-- <span class="{{$IncomingStudentCount == 0 ? '' : 'label label-danger'}} pull-right">
                {{$IncomingStudentCount == 0 ? '' : $IncomingStudentCount}}
              </span> --}}
            </a>
            <ul class="treeview-menu" style="display: none">
              {{--  Admin Menu  --}}
                <li class="{{request()->routeIs('admission.incoming_student') ? 'active' : '' }}">
                  <a href="{{ route('admission.incoming_student')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Not yet Approved</span></a>
                </li>
                <li class="{{request()->routeIs('admission.Approved') ? 'active' : '' }}">
                  <a href="{{ route('admission.Approved')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Approved</span></a>
                </li>
                <li class="{{request()->routeIs('admission.Disapproved') ? 'active' : '' }}">
                  <a href="{{ route('admission.Disapproved')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Disapproved</span></a>
                </li>
              </ul>
          </li>
          <li class="{{request()->routeIs('registrar.class_details') ? 'active' : '' }}">
            <a href="{{ route('registrar.class_details') }}"><i class="fa fa-list-alt  fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Class Lists</span></a>
          </li>
          <li>
            <a href="#">
              <i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; 
              <span>Student Sectioning</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            {{-- <a href="{{ route('registrar.student_admission') }}"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Admission</span></a> --}}
              <ul class="treeview-menu" style="display: none">
                {{--  Admin Menu  --}}
                  <li class="{{request()->routeIs('registrar.student_admission.grade7') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade7')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 7</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade8') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade8')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 8</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade9') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade9')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 9</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade10') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade10')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 10</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade11') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade11')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 11</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade12') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade12')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 12</span></a>
                  </li>
              </ul>
          </li>
          <li class="{{request()->routeIs('admin.transcript_archieve') ? 'active' : '' }}">
            <a href="{{ route('admin.transcript_archieve') }}"><i class="fa fa-archive fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Transcript Archive</span></a>
          </li>
          <li class="{{request()->routeIs('admin.articles') ? 'active' : '' }}">
            <a href="{{ route('admin.articles') }}"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>News and Events</span></a>
          </li>

        @endif
        {{--  Admin Menu End  --}}
        
        {{--  Registrar Menu  --}}
        @if (Auth::user()->role == 3)
          <li class="{{request()->routeIs('registrar.dashboard') ? 'active' : '' }}">
            <a href="{{ route('registrar.dashboard') }}"><i class="fa fa-home fa-fw fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Dashboard</span></a>
          </li>
          <li class="{{request()->routeIs('admission.incoming_student') ? 'active' : '' }}">
            <a href="{{ route('admission.incoming_student') }}"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Incoming Student</span></a>
          </li>
          <li class="{{request()->routeIs('registrar.class_details') ? 'active' : '' }}">
            <a href="{{ route('registrar.class_details') }}"><i class="fa fa-list-alt fa-lg "></i>&nbsp;&nbsp;&nbsp; <span>Class Lists</span></a>
          </li>  
          <li>
            <a href="#">
              <i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; 
              <span>Student Sectioning</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            {{-- <a href="{{ route('registrar.student_admission') }}"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Admission</span></a> --}}
              <ul class="treeview-menu menu-open" style="display: block">
                {{--  Admin Menu  --}}
                  <li class="{{request()->routeIs('registrar.student_admission.grade7') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade7')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 7</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade8') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade8')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 8</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade9') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade9')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 9</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade10') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade10')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 10</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade11') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade11')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 11</span></a>
                  </li>
                  <li class="{{request()->routeIs('registrar.student_admission.grade12') ? 'active' : '' }}">
                    <a href="{{ route('registrar.student_admission.grade12')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 12</span></a>
                  </li>
              </ul>
          </li>
          <li class="{{request()->routeIs('shared.faculty_class_schedules.index') ? 'active' : '' }}">
            <a href="{{ route('shared.faculty_class_schedules.index') }}"><i class="fa fa-file-text-o fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Class Schedule</span></a>
          </li>
          <li class="{{request()->routeIs('admin.faculty_information') ? 'active' : '' }}">
            <a href="{{ route('admin.faculty_information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Information</span></a>
          </li>
          <li class="{{request()->routeIs('admin.student.information') ? 'active' : '' }}">
            <a href="{{ route('admin.student.information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Information</span></a>
          </li>           
        @endif
        
        {{--  Faculty Menu  --}}
        @if (Auth::user()->role == 4)
          <li class="{{request()->routeIs('faculty.dashboard') ? 'active' : '' }}"><a href="{{ route('faculty.dashboard') }}"><i class="fa fa-home fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;Dashboard</a></li>
          <li class="{{request()->routeIs('faculty.subject_class') ? 'active' : '' }}"><a href="{{ route('faculty.subject_class') }}"><i class="fa fa-sticky-note-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Subject Class</span></a></li>
          <li class="{{request()->routeIs('faculty.faculty_class_schedules') ? 'active' : '' }}"><a href="{{ route('faculty.faculty_class_schedules') }}"><i class="fa fa-file-text-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Faculty Class Schedules</span></a></li>
          <li class="{{request()->routeIs('faculty.student_grade_sheet') ? 'active' : '' }}"><a href="{{ route('faculty.student_grade_sheet') }}"><i class="fa fa-pencil-square-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Encode Student Grades</span></a></li>
          
          {{-- <li><a href="{{ route('faculty.DataStudent') }}"><i class="fa fa-circle-o"></i> <span>Make Data for GradeSheet</span></a></li> --}}
          <li class="{{request()->routeIs('faculty.class-attendance.index') ? 'active' : '' }}"><a href="{{ route('faculty.class-attendance.index') }}"><i class="fa fa-calendar-plus-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Encode Class Attendance</span></a></li>
          <li class="{{request()->routeIs('faculty.encode-remarks.index') ? 'active' : '' }}"><a href="{{ route('faculty.encode-remarks.index') }}"><i class="fa fa-pencil-square-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Print Class Card</span></a></li>
          <li class="{{request()->routeIs('faculty.class_demographic_profile.index') ? 'active' : '' }}"><a href="{{ route('faculty.class_demographic_profile.index') }}"><i class="fa fa-info-circle fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Demographic Profile</span></a></li>
          <li class="{{request()->routeIs('faculty.advisory_class.index') ? 'active' : '' }}"><a href="{{ route('faculty.advisory_class.index') }}"><i class="fa fa-users fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>My Advisory Class</span></a></li>
          
         {{--  <li><a href="{{ route('faculty.my_advisory_class.index') }}"><i class="fa fa-circle-o"></i> <span>My Advisory Class</span></a>  --}}
            
          </li>
        @endif

        {{-- Admission --}}
        @if (Auth::user()->role == 7)
          <li class="{{request()->routeIs('admission.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admission.dashboard') }}">
              <i class="fa fa-home fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;Dashboard
            </a>
          </li>
          <li>
            <a href="#"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Incoming Student</span>
              <span class="{{$IncomingStudentCount == 0 ? '' : 'label label-danger'}} pull-right">
                {{$IncomingStudentCount == 0 ? '' : $IncomingStudentCount}}
              </span>
            </a>
            <ul class="treeview-menu menu-open" style="display: block">
              {{--  Admin Menu  --}}
                <li class="{{request()->routeIs('admission.incoming_student') ? 'active' : '' }}">
                  <a href="{{ route('admission.incoming_student')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Not yet Approved</span></a>
                </li>
                <li class="{{request()->routeIs('admission.Approved') ? 'active' : '' }}">
                  <a href="{{ route('admission.Approved')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Approved</span></a>
                </li>
                <li class="{{request()->routeIs('admission.Disapproved') ? 'active' : '' }}">
                  <a href="{{ route('admission.Disapproved')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Disapproved</span></a>
                </li>
              </ul>
          </li>
          <li class="{{request()->routeIs('admin.student.information') ? 'active' : '' }}">
            <a href="{{ route('admin.student.information') }}"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Information</span></a>
          </li>    
        @endif
        {{--  
        @if (Auth::user()->role == 3)
        @endif               --}}
          {{--  Registrar Menu End  --}}
        @if (Auth::user()->role == 1 || Auth::user()->role == 0)
          <li class="treeview">
              <a href="#">
                <i class="fa fa-cog fa-lg"></i>&nbsp;&nbsp;&nbsp; 
                <span>Maintenance</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu" style="display: none">
                  {{--  Admin Menu  --}}
                  <li class="{{request()->routeIs('admin.student.information') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.information') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Class Rooms</span></a>
                  </li>
                  <li class="{{request()->routeIs('admin.student.information') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.information') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Date of Remarks</span></a>
                  </li>
                  <li class="{{request()->routeIs('admin.maintenance.school_year') ? 'active' : '' }}">
                    <a href="{{ route('admin.maintenance.school_year') }}">
                      <i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>School Year</span>
                      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu" style="display: block">
                      <li class="{{request()->routeIs('admin.maintenance.school_year') ? 'active' : '' }}">
                        <a href="{{ route('admin.maintenance.school_year') }}">
                          <i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Add School Year</span>
                        </a>
                      </li>
                      <li class="{{request()->routeIs('admin.maintenance.school_year_settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.maintenance.school_year_settings')}}">
                          <i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>School Year Setting</span>
                        </a>
                      </li>
                      {{-- <li><a href=""><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Student</span></a></li>
                      <li><a href=""><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Registrar</span></a></li> --}}
                    </ul>
                  </li>
                  <li class="{{request()->routeIs('admin.maintenance.semester') ? 'active' : '' }}">
                    <a href="{{ route('admin.maintenance.semester') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Semester</span></a>
                  </li>
                  <li class="{{request()->routeIs('admin.maintenance.strand') ? 'active' : '' }}">
                    <a href="{{ route('admin.maintenance.strand') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Strands</span></a>
                  </li>
                  <li class="{{request()->routeIs('admin.maintenance.student_attendance') ? 'active' : '' }}">
                    <a href="{{ route('admin.maintenance.student_attendance') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Attendance Setup</span></a>
                  </li>
                  <li class="{{request()->routeIs('admin.maintenance.subjects') ? 'active' : '' }}">
                    <a href="{{ route('admin.maintenance.subjects') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Subjects</span></a>
                  </li>
                  <li class="{{request()->routeIs('admin.maintenance.section_details') ? 'active' : '' }}">
                    <a href="{{ route('admin.maintenance.section_details') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Section Details</span></a>
                  </li>
                  
                  {{--  Admin Menu End  --}}                  
              </ul>
          </li>
        @endif

        {{-- Finance Menu --}}
        @if (Auth::user()->role == 6 )
          <li class="{{request()->routeIs('finance.dashboard') ? 'active' : '' }}">
            <a href="{{ route('finance.dashboard') }}"><i class="fa fa-home fa-fw fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Dashboard</span></a>
          </li>
          {{-- <li><a href="{{ route('finance.student_account') }}"><i class="fas fa-pen-square fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Enrollment</span></a></li> --}}
          {{-- <li><a href="{{ route('finance.student_payment') }}">&nbsp;<i class="fas fa-clipboard-list fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Payment </i> --}}
          <li class="{{request()->routeIs('finance.student_account') ? 'active' : '' }}">
            <a href="{{ route('finance.student_account') }}"><i class="fas fa-pen-square fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Enrollment/Billing</span></a>
          </li>
          {{-- <li><a href="{{ route('finance.class_details') }}"><i class="fas fa-pen-square fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Enrollment/Billing</span></a></li> --}}
          <li>
            <a href="#"><i class="fas fa-clipboard-list fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Payment</span>
              
            </a>
            <ul class="treeview-menu menu-open" style="display: block">
              {{--  Admin Menu  --}}
                <li>
                  <a href="{{ route('finance.student_payment.not_yet_approved')}}">
                    <i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Not yet Approved</span>
                    <span class="{{$NotyetApprovedCount == 0 ? '' : 'label label-danger'}} pull-right">
                      {{$NotyetApprovedCount == 0 ? '' : $NotyetApprovedCount}}
                    </span>
                  </a>
                </li>
                <li class="{{request()->routeIs('finance.student_payment.approved') ? 'active' : '' }}">
                  <a href="{{ route('finance.student_payment.approved')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Approved</span></a>
                </li>
                <li class="{{request()->routeIs('finance.student_payment.disapproved') ? 'active' : '' }}">
                  <a href="{{ route('finance.student_payment.disapproved')}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Disapproved</span></a>
                </li>
              </ul>
          </li>
          {{-- </span></a></li> --}}
          <li class="{{request()->routeIs('finance.student_acct') ? 'active' : '' }}">
            <a href="{{ route('finance.student_acct') }}"> <i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Account</span></a>
          </li>
          <li class="{{request()->routeIs('finance.summary') ? 'active' : '' }}">
            <a href="{{ route('finance.summary') }}">
            <i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Payment Summary</span></a>
          </li>
          <li class="{{request()->routeIs('finance.summary.subsidy_discount') ? 'active' : '' }}">
            <a href="{{ route('finance.summary.subsidy_discount') }}">
              <i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Discount/Subsidy Summary</span>
            </a>
          </li>
          {{-- <li><a href="{{ route('finance.summary') }}">
            <i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Section Summary</span></a>
          </li> --}}
          <li class="{{request()->routeIs('finance.online_appointment.date_time') ? 'active' : '' }}">
            <a href="{{ route('finance.online_appointment.date_time') }}">
              <i class="far fa-calendar-check fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Online Appointment</span>
            </a>
          </li>
          
          
          {{-- <li><a href="{{ route('registrar.class_details') }}"><i class="fa fa-list-alt fa-lg "></i>&nbsp;&nbsp;&nbsp; <span>Report</span></a></li> --}}
          <li class="{{request()->routeIs('') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-cog fa-lg "></i>&nbsp;&nbsp;&nbsp;<span>Maintenance</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i><span class="label label-primary pull-right">5</span></span>              
            </a>
            <ul class="treeview-menu menu-open" style="display: block">
                <li class="{{request()->routeIs('finance.maintenance.tuition_fee') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.tuition_fee') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Tuition Fee</span></a>
                </li>
                <li class="{{request()->routeIs('finance.maintenance.downpayment') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.downpayment') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Downpayment Fee</span></a>
                </li>
                <li class="{{request()->routeIs('finance.maintenance.misc_fee') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.misc_fee') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Miscellaneous Fee</span></a>
                </li> 
                <li class="{{request()->routeIs('finance.maintenance.subsidy') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.subsidy') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Subsidy</span></a>
                </li>               
                <li class="{{request()->routeIs('finance.maintenance.disc_fee') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.disc_fee') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Discount</span></a>
                </li>
                <li class="{{request()->routeIs('finance.maintenance.payment_category') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.payment_category') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Payment Category</span></a>
                </li>
                <li class="{{request()->routeIs('finance.maintenance.other_fee') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.other_fee') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Other Fee</span></a>
                </li>
                <li class="{{request()->routeIs('finance.maintenance.queue') ? 'active' : '' }}">
                  <a href="{{ route('finance.maintenance.queue') }}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Online Appointment Set-up</span></a>
                </li>
            </ul>
          </li>   
        @endif
        <li class="
          @if(request()->routeIs('registrar.my_account.index'))
            active
          @endif
          @if(request()->routeIs('faculty.my_account.index'))
            active
          @endif
          @if(request()->routeIs('finance.my_account.index'))
            active
          @endif
          @if(request()->routeIs('admission.my_account.index'))
            active
          @endif
          @if(request()->routeIs('my_account.index'))
            active
          @endif
        ">
          @if (Auth::user()->role == 3)
            <a href="{{ route('registrar.my_account.index') }}"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a>
          @elseif (Auth::user()->role == 4)
            <a href="{{ route('faculty.my_account.index') }}"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a>
          @elseif (Auth::user()->role == 6)
            <a href="{{ route('finance.my_account.index') }}"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a>
          @elseif (Auth::user()->role == 7)
            <a href="{{ route('admission.my_account.index') }}"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a>
          @elseif (Auth::user()->role == 0 || Auth::user()->role == 1)
            <a href="{{ route('my_account.index') }}"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a>
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