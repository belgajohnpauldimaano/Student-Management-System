@include('control_panel.layouts.header')


<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
<div class="wrapper">    
  <!-- Navbar Right Menu -->
  <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-danger">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu"
            href="#" role="button">
              <i class="fas fa-bars text-lg"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">School Year: {{ $SchoolYear->school_year }}</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            @include('control_panel.layouts.notification')
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen"
            href="#" role="button">            
              <i class="fas fa-expand-arrows-alt text-lg"></i>
            </a>
          </li>
          <li class="nav-item dropdown user user-menu">
            <a class="nav-link" data-toggle="dropdown"
            href="#">
              <img style="width: 30px ;margin-top: -8px;"
                src="{{ \Auth::user()->get_user_data()->photo ? 
                  \File::exists(public_path('/img/account/photo/'. 
                  \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. 
                  \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : 
                  asset('/img/account/photo/blank-user.gif') }}" class="user-image elevation-2" alt="User Image"
              >
              <span class="hidden-xs">{{ \Auth::user()->get_user_data()->full_name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="text-center">
                    <img style="width: 100px; margin-top: -5px;" src="{{ \Auth::user()->get_user_data()->photo ? 
                    \File::exists(public_path('/img/account/photo/'. 
                    \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. 
                    \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : 
                    asset('/img/account/photo/blank-user.gif') }}" class="profile-user-img img-responsive img-circle elevation-2" alt="User Image"
                    >
                    <br/>
                    <p>
                      {{ \Auth::user()->get_user_data()->full_name }}<br/>
                      <small>{{ \Auth::user()->get_user_role_display() }}</small>
                    </p>
                  </div>
              </a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center"
                href="
                  @if (Auth::user()->role == 3)
                    {{ route('registrar.my_account.index') }}
                  @elseif (Auth::user()->role == 4)
                    {{ route('faculty.my_account.index') }}
                  @elseif (Auth::user()->role == 6)
                    {{ route('finance.my_account.index') }}
                  @elseif (Auth::user()->role == 7)
                    {{ route('admission.my_account.index') }}
                  @elseif (Auth::user()->role == 0 || Auth::user()->role == 1)
                    {{ route('my_account.index') }}
                  @endif
                ">
                  <i class="fa fa-user mr-2"></i> My Profile
                </a>
              <div class="dropdown-divider"></div>
              <div class="p-2">
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
                    class="btn btn-danger btn-block">
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
    
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar elevation-4 sidebar-light-danger">
      <!-- Brand Logo -->
      <a href="/" class="brand-link navbar-danger">
        <img src="{{ asset('/img/sja-logo.png') }}"  class="brand-image img-circle elevation-3" style="height: 35px; opacity: .8">
        <span class="brand-text font-weight-bold text-white">ST. JOHN'S ACADEMY INC.</span>
      </a>

      <!-- sidebar menu: : style can be found in sidebar.less -->
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
            <li class="nav-header">MAIN NAVIGATION</li>
            {{--  Admin Menu  --}}
            @if (Auth::user()->role == 1 || Auth::user()->role == 0)
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                  <i class="fa fa-home fa-fw fa-lg"></i> <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('shared.faculty_class_schedules.index') ? 'active' : '' }}"
                   href="{{ route('shared.faculty_class_schedules.index') }}">
                  <i class="far fa-calendar fa-lg"></i> <p>Faculty Class Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.admission_information') ? 'active' : '' }}"
                   href="{{ route('admin.admission_information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Admission Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.faculty_information') ? 'active' : '' }}"
                   href="{{ route('admin.faculty_information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Faculty Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.registrar_information') ? 'active' : '' }}"
                   href="{{ route('admin.registrar_information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Registrar Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.finance_information') ? 'active' : '' }}"
                   href="{{ route('admin.finance_information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Finance Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.student.information') ? 'active' : '' }}"
                   href="{{ route('admin.student.information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Student Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admission.incoming') ? 'active' : '' }}"
                   href="{{ route('admission.incoming', ['tab' => 'not-yet-approved']) }}">
                   <i class="fa fa-info-circle fa-lg"></i>
                      <span class="{{$IncomingStudentCount == 0 ? '' : 'badge badge-info'}} js-incoming_stud right">
                        {{$IncomingStudentCount == 0 ? '' : $IncomingStudentCount}}
                      </span>
                   <p>Incoming Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('registrar.class_details') ? 'active' : '' }}"
                   href="{{ route('registrar.class_details') }}">
                  <i class="fa fa-list-alt  fa-lg"></i> <p>Class Lists</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link
                {{
                  request()->routeIs('registrar.student_admission.grade7') ? 'active menu-open' : '' ||
                  request()->routeIs('registrar.student_admission.grade8') ? 'active menu-open' : '' ||
                  request()->routeIs('registrar.student_admission.grade9') ? 'active menu-open' : '' ||
                  request()->routeIs('registrar.student_admission.grade10') ? 'active menu-open' : '' ||
                  request()->routeIs('registrar.student_admission.grade11') ? 'active menu-open' : '' ||
                  request()->routeIs('registrar.student_admission.grade12') ? 'active menu-open' : ''
                }}
                ">
                  <i class="fas fa-users fa-lg"></i>
                    <p>Student Sectioning</p>
                  <i class="fas fa-angle-left right"></i>
                </a>
                  <ul class="nav nav-treeview
                    {{
                      request()->routeIs('registrar.student_admission.grade7') ? 'd-block' : '' ||
                      request()->routeIs('registrar.student_admission.grade8') ? 'd-block' : '' ||
                      request()->routeIs('registrar.student_admission.grade9') ? 'd-block' : '' ||
                      request()->routeIs('registrar.student_admission.grade10') ? 'd-block' : '' ||
                      request()->routeIs('registrar.student_admission.grade11') ? 'd-block' : '' ||
                      request()->routeIs('registrar.student_admission.grade12') ? 'd-block' : ''
                    }}
                  ">
                    {{--  Admin Menu  --}}
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade7') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade7')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 7</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade8') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade8')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 8</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade9') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade9')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 9</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade10') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade10')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 10</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade11') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade11')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 11</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade12') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade12')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 12</p>
                        </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.transcript_archieve') ? 'active' : '' }}"
                   href="{{ route('admin.transcript_archieve') }}">
                  <i class="fa fa-archive fa-lg"></i> <p>Transcript Archive</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.articles') ? 'active' : '' }}"
                   href="{{ route('admin.articles') }}">
                  <i class="far fa-newspaper fa-lg"></i> <p>News and Events</p>
                </a>
              </li>
            @endif
            {{--  Admin Menu End  --}}
            
            {{--  Registrar Menu  --}}
            @if (Auth::user()->role == 3)
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('registrar.dashboard') ? 'active' : '' }}"
                   href="{{ route('registrar.dashboard') }}">
                  <i class="fa fa-home fa-fw fa-lg"></i> <p>Dashboard</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admission.incoming_student') ? 'active' : '' }}"
                   href="{{ route('admission.incoming_student') }}">
                  <i class="fas fa-users fa-lg"></i> <p>Incoming Student</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admission.incoming') ? 'active' : '' }}"
                   href="{{ route('admission.incoming', ['tab' => 'not-yet-approved']) }}">
                      <i class="fa fa-info-circle fa-lg"></i>
                      <span class="{{$IncomingStudentCount == 0 ? '' : 'badge badge-info'}} js-incoming_stud right">
                        {{$IncomingStudentCount == 0 ? '' : $IncomingStudentCount}}
                      </span>
                      <p>Incoming Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('registrar.class_details') ? 'active' : '' }}"
                   href="{{ route('registrar.class_details') }}">
                  <i class="fa fa-list-alt fa-lg "></i> <p>Class Lists</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="fas fa-users fa-lg"></i>                   
                    <p>Student Sectioning</p>
                  <i class="fas fa-angle-left right"></i>
                </a>
                {{-- <a href="{{ route('registrar.student_admission') }}">
                  <i class="fas fa-users fa-lg"></i> <p>Student Admission</p>
                </a> --}}
                  <ul class="nav nav-treeview">
                    {{--  Admin Menu  --}}
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade7') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade7')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 7</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade8') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade8')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 8</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade9') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade9')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 9</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade10') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade10')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 10</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade11') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade11')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 11</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('registrar.student_admission.grade12') ? 'active' : '' }}"
                           href="{{ route('registrar.student_admission.grade12')}}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Grade 12</p>
                        </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('shared.faculty_class_schedules.index') ? 'active' : '' }}"
                   href="{{ route('shared.faculty_class_schedules.index') }}">
                  <i class="far fa-calendar fa-lg"></i> <p>Faculty Class Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.faculty_information') ? 'active' : '' }}"
                   href="{{ route('admin.faculty_information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Faculty Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.student.information') ? 'active' : '' }}"
                   href="{{ route('admin.student.information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Student Information</p>
                </a>
              </li>           
            @endif
            
            {{--  Faculty Menu  --}}
            @if (Auth::user()->role == 4)
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.home') ? 'active' : '' }}"
                   href="{{ route('faculty.home') }}">
                  <i class="fa fa-home fa-fw fa-lg"></i> <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.dashboard') ? 'active' : '' }}"
                   href="{{ route('faculty.dashboard') }}">
                  <i class="fas fa-tachometer-alt fa-lg"></i> <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.subject_class') ? 'active' : '' }}"
                   href="{{ route('faculty.subject_class') }}">
                <i class="fas fa-list fa-lg"></i> <p>Subject Class</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.faculty_class_schedules') ? 'active' : '' }}"
                   href="{{ route('faculty.faculty_class_schedules') }}">
                  <i class="far fa-calendar fa-lg"></i> <p>Faculty Class Schedules</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.student_grade_sheet') ? 'active' : '' }}"
                   href="{{ route('faculty.student_grade_sheet') }}">
                  <i class="far fa-edit fa-lg"></i> <p>Encode Student Grades</p>
                </a>
              </li>
              {{-- <li class="nav-item"><a href="{{ route('faculty.DataStudent') }}">
                  <i class="far fa-circle nav-icon fa-1x"></i> <p>Make Data for GradeSheet</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.class-attendance.index') ? 'active' : '' }}"
                   href="{{ route('faculty.class-attendance.index') }}">
                  <i class="far fa-edit fa-lg"></i> <p>Encode Class Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.encode-remarks.index') ? 'active' : '' }}"
                   href="{{ route('faculty.encode-remarks.index') }}">
                  <i class="far fa-edit fa-lg"></i> <p>Print Class Card</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.class_demographic_profile.index') ? 'active' : '' }}"
                   href="{{ route('faculty.class_demographic_profile.index') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Demographic Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('faculty.advisory_class.index*') ? 'active' : '' }}"
                   href="{{ route('faculty.advisory_class.index') }}">
                  <i class="fa fa-users fa-lg"></i> <p>My Advisory Class</p>
                </a>
              </li>
              <li class="nav-header">LMS</li>
              <li class="nav-item">
                <a class="nav-link"
                   href="">
                  <i class="fas fa-book fa-lg"></i> <p>My Lesson</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link"
                   href="">
                  <i class="far fa-edit fa-lg"></i> <p>Assignment</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link 
                {{
                  request()->routeIs('faculty.assessment') ? 'active' : '' || 
                  request()->routeIs('finance.assessment_subject.create') ? 'active' : '' || 
                  request()->routeIs('faculty.assessment_subject') ? 'active' : '' ||
                  request()->routeIs('faculty.assessment.archive') ? 'active' : '' ||
                  request()->routeIs('faculty.assessment.publish') ? 'active' : '' ||

                  request()->routeIs('faculty.assessment_subject') ? 'active' : '' ||
                  request()->routeIs('faculty.assessment_subject.create') ? 'active' : '' ||
                  request()->routeIs('faculty.assessment_subject.edit') ? 'active' : '' ||

                  request()->routeIs('faculty.question') ? 'active' : '' ||
                  request()->routeIs('faculty.question.edit') ? 'active' : '' 
                }}"
                   href="{{ route('faculty.assessment') }}">
                  <i class="fas fa-user-clock fa-lg"></i> <p>Assessment</p>
                </a>
              </li>
            @endif

            {{-- Admission --}}
            @if (Auth::user()->role == 7)
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admission.dashboard') ? 'active' : '' }}"
                   href="{{ route('admission.dashboard') }}">
                  <i class="fa fa-home fa-fw fa-lg"></i> <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admission.incoming') ? 'active' : '' }}"
                   href="{{ route('admission.incoming', ['tab' => 'not-yet-approved']) }}">
                  <i class="fa fa-info-circle fa-lg"></i>
                    <span class="{{$IncomingStudentCount == 0 ? '' : 'badge badge-info '}} js-incoming_stud right">
                        {{$IncomingStudentCount == 0 ? '' : $IncomingStudentCount}}
                    </span> <p>Incoming Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('admin.student.information') ? 'active' : '' }}"
                   href="{{ route('admin.student.information') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Student Information</p>
                </a>
              </li>
            @endif
            {{--  
            @if (Auth::user()->role == 3)
            @endif               --}}
              {{--  Registrar Menu End  --}}
            @if (Auth::user()->role == 1 || Auth::user()->role == 0)
              <li class="nav-header">MAINTENANCE/SETTINGS</li>
              <li class="nav-item">
                  <a href="#" class="nav-link
                    {{
                      request()->routeIs('admin.maintenance.classrooms') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.date_remarks_for_class_card') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.registration_button') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.school_year') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.semester') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.strand') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.student_attendance') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.subjects') ? 'active menu-open' : '' ||
                      request()->routeIs('admin.maintenance.section_details') ? 'active menu-open' : '' 
                      
                    }}
                  ">
                    <i class="fa fa-cog fa-lg"></i> 
                      <p>Maintenance</p>
                    <i class="fas fa-angle-left right"></i>
                  </a>
                  <ul class="nav nav-treeview 
                    {{
                        request()->routeIs('admin.maintenance.classrooms') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.date_remarks_for_class_card') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.registration_button') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.school_year') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.semester') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.strand') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.student_attendance') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.subjects') ? 'd-block' : '' ||
                        request()->routeIs('admin.maintenance.section_details') ? 'd-block' : ''
                      }}
                  ">
                      {{--  Admin Menu  --}}
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.classrooms') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.classrooms') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Class Rooms</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.date_remarks_for_class_card') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.date_remarks_for_class_card') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Date of Remarks</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.registration_button') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.registration_button') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Registration Button</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.school_year') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.school_year') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>School Year</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.semester') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.semester') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Semester</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.strand') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.strand') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Strands</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.student_attendance') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.student_attendance') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Attendance Setup</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.subjects') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.subjects') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Subjects</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('admin.maintenance.section_details') ? 'active' : '' }}"
                           href="{{ route('admin.maintenance.section_details') }}">
                          <i class="far fa-circle nav-icon fa-1x"></i> <p>Section Details</p>
                        </a>
                      </li>
                      {{--  Admin Menu End  --}}
                  </ul>
              </li>
            @endif

            {{-- Finance Menu --}}
            @if (Auth::user()->role == 6 )
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.dashboard') ? 'active' : '' }}"
                   href="{{ route('finance.dashboard') }}">
                  <i class="fa fa-home fa-fw fa-lg"></i> <p>Dashboard</p>
                </a>
              </li>
              {{-- <li class="nav-item"><a href="{{ route('finance.student_account') }}">
                  <i class="fas fa-pen-square fa-lg"></i> <p>Student Enrollment</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item"><a href="{{ route('finance.student_payment') }}">&nbsp;
                <i class="fas fa-clipboard-list fa-lg"></i> <p>Student Payment </i> --}}
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.student_account') ? 'active' : '' }}"
                   href="{{ route('finance.student_account') }}">
                  <i class="fas fa-pen-square fa-lg"></i> <p>Student Enrollment/Billing</p>
                </a>
              </li>
              {{-- <li class="nav-item"><a href="{{ route('finance.class_details') }}">
                  <i class="fas fa-pen-square fa-lg"></i> <p>Student Enrollment/Billing</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a href="#" class="nav-link
                  {{
                    request()->routeIs('finance.student_payment.not_yet_approved') ? 'active menu-open' : '' || 
                    request()->routeIs('finance.student_payment.approved') ? 'active menu-open' : '' || 
                    request()->routeIs('finance.student_payment.disapproved') ? 'active menu-open' : ''
                  }}
                ">
                  <i class="fas fa-clipboard-list fa-lg"></i>
                    <p>Student Payment</p>
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview d-block
                  {{-- {{
                    request()->routeIs('finance.student_payment.not_yet_approved') ? 'd-block' : '' || 
                    request()->routeIs('finance.student_payment.approved') ? 'd-block' : '' || 
                    request()->routeIs('finance.student_payment.disapproved') ? 'd-block' : ''
                  }} --}}
                ">
                  {{--  Admin Menu  --}}
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.student_payment.not_yet_approved') ? 'active' : '' }}"
                         href="{{ route('finance.student_payment.not_yet_approved')}}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Not yet Approved</p>
                        <span class="{{$NotyetApprovedCount == 0 ? '' : 'badge badge-info'}} right js-notYetApprovedCount">
                           {{$NotyetApprovedCount == 0 ? '' : $NotyetApprovedCount}}
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.student_payment.approved') ? 'active' : '' }}"
                         href="{{ route('finance.student_payment.approved')}}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Approved</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.student_payment.disapproved') ? 'active' : '' }}"
                         href="{{ route('finance.student_payment.disapproved')}}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Disapproved</p>
                      </a>
                    </li>
                  </ul>
              </li>
              {{-- </span></a></li> --}}
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.student_acct') ? 'active' : '' }}"
                   href="{{ route('finance.student_acct') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Student Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.summary') ? 'active' : '' }}"
                   href="{{ route('finance.summary') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Payment Summary</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.summary.subsidy_discount') ? 'active' : '' }}"
                   href="{{ route('finance.summary.subsidy_discount') }}">
                  <i class="fa fa-info-circle fa-lg"></i> <p>Discount/Subsidy Summary</p>
                </a>
              </li>
              {{-- <li class="nav-item"><a href="{{ route('finance.summary') }}">
                <i class="fa fa-info-circle fa-lg"></i> <p>Section Summary</p>
              </a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.online_appointment.date_time') ? 'active' : '' }}"
                   href="{{ route('finance.online_appointment.date_time') }}">
                  <i class="far fa-calendar-check fa-lg"></i> <p>Online Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('finance.payroll') ? 'active' : '' }}"
                   href="{{ route('finance.payroll') }}">
                  <i class="fas fa-file-invoice fa-lg"></i> <p>Employee Payroll</p>
                </a>
              </li>

              {{-- <li class="nav-item"><a href="{{ route('registrar.class_details') }}">
                  <i class="fa fa-list-alt fa-lg "></i> <p>Report</p>
                </a>
              </li> --}}
              <li class="nav-header">MAINTENANCE/SETTINGS</li>
              <li class="nav-item">
                <a href="#" class="nav-link
                  {{
                      request()->routeIs('finance.maintenance.tuition_fee') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.downpayment') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.misc_fee') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.subsidy') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.disc_fee') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.payment_category') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.other_fee') ? 'active menu-open' : '' ||
                      request()->routeIs('finance.maintenance.queue') ? 'active menu-open' : ''
                  }}
                ">
                  <i class="fa fa-cog fa-lg "></i> <p>Maintenance</p>
                  {{-- <span class="badge badge-info">
                    5
                  </span> --}}
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview
                  {{
                      request()->routeIs('finance.maintenance.tuition_fee') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.downpayment') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.misc_fee') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.subsidy') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.disc_fee') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.payment_category') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.other_fee') ? 'd-block' : '' ||
                      request()->routeIs('finance.maintenance.queue') ? 'd-block' : ''
                  }}
                ">
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.tuition_fee') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.tuition_fee') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Tuition Fee</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.downpayment') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.downpayment') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Downpayment Fee</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.misc_fee') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.misc_fee') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Miscellaneous Fee</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.subsidy') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.subsidy') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Subsidy</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.disc_fee') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.disc_fee') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Discount</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.payment_category') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.payment_category') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Payment Category</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.other_fee') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.other_fee') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Other Fee</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('finance.maintenance.queue') ? 'active' : '' }}"
                         href="{{ route('finance.maintenance.queue') }}">
                        <i class="far fa-circle nav-icon fa-1x"></i> <p>Online Appointment Set-up</p>
                      </a>
                    </li>
                </ul>
              </li>
            @endif
            {{-- <li class="nav-item">
              @if (Auth::user()->role == 3)
                <a class="nav-link {{request()->routeIs('registrar.my_account.index') ? 'active' : '' }}"
                   href="{{ route('registrar.my_account.index') }}">
                  <i class="fa fa-user fa-lg"></i> <p>My Account</p>
                </a>
              @elseif (Auth::user()->role == 4)
                <a class="nav-link {{request()->routeIs('faculty.my_account.index') ? 'active' : '' }}"
                   href="{{ route('faculty.my_account.index') }}">
                  <i class="fa fa-user fa-lg"></i> <p>My Account</p>
                </a>
              @elseif (Auth::user()->role == 6)
                <a class="nav-link {{request()->routeIs('finance.my_account.index') ? 'active' : '' }}"
                   href="{{ route('finance.my_account.index') }}">
                  <i class="fa fa-user fa-lg"></i> <p>My Account</p>
                </a>
              @elseif (Auth::user()->role == 7)
                <a class="nav-link {{request()->routeIs('admission.my_account.index') ? 'active' : '' }}"
                   href="{{ route('admission.my_account.index') }}">
                  <i class="fa fa-user fa-lg"></i> <p>My Account</p>
                </a>
              @elseif (Auth::user()->role == 0 || Auth::user()->role == 1)
                <a class="nav-link {{request()->routeIs('my_account.index') ? 'active' : '' }}"
                   href="{{ route('my_account.index') }}">
                  <i class="fa fa-user fa-lg"></i> <p>My Account</p>
                </a>
              @endif
            </li> --}}
          </ul>
        </nav>
      </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">
              @yield('content_title')
            </h1>
          </div>
        </div>
      </div>
    </div>
    
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