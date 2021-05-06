@if (Auth::user()->role == 6 )
  <li class="nav-item">
    <a class="nav-link {{request()->routeIs('finance.dashboard') ? 'active' : '' }}"
       href="{{ route('finance.dashboard') }}">
      <i class="fa fa-home fa-fw fa-lg"></i> <p>Dashboard</p>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->routeIs('finance.student_account') ? 'active' : '' }}"
       href="{{ route('finance.student_account') }}">
      <i class="fas fa-pen-square fa-lg"></i> <p>Student Enrollment/Billing</p>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->routeIs('finance.student_payment.index') ? 'active' : '' }}"
       href="{{ route('finance.student_payment.index') }}">
      <i class="fas fa-clipboard-list fa-lg"></i> <p>Student Payment</p> 
        <span class="{{$NotyetApprovedCount == 0 ? 'd-none' : ''}}badge badge-info right js-notYetApprovedCount">
          {{$NotyetApprovedCount == 0 ? '' : $NotyetApprovedCount}}
        </span>
    </a>
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