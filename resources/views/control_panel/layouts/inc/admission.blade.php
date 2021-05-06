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
        <span class="{{$IncomingStudentCount == 0 ? 'd-none' : ''}}badge badge-info js-incoming_stud right">
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