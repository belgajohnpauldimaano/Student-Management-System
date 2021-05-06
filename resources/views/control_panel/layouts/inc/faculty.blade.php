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