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
          <span class="{{$IncomingStudentCount == 0 ? 'd-none' : ''}}badge badge-info js-incoming_stud right">
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