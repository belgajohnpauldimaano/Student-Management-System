<?php echo $__env->make('control_panel.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<body class="hold-transition skin-black sidebar-mini fixed skin-red-light">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <span class="logo-mini"><img src="<?php echo e(asset('/img/sja-logo.png')); ?>" style="height: 35px;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        
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
                    
                    <span class="hidden-xs"><?php echo e(\Auth::user()->get_user_data()->first_name . ' ' . \Auth::user()->get_user_data()->last_name); ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?php echo e(\Auth::user()->get_user_data()->photo ? \File::exists(public_path('/img/account/photo/'. \Auth::user()->get_user_data()->photo)) ? asset('/img/account/photo/'. \Auth::user()->get_user_data()->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif')); ?>" class="img-circle" alt="User Image">
                        <p>
                          <small><?php echo e(\Auth::user()->get_user_role_display()); ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        
                        <div class="pull-right">
                            
                            <a href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                                class="btn btn-default btn-flat">
                                Logout
                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

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
        
        <?php if(Auth::user()->role == 1 || Auth::user()->role == 0): ?>
          <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa  fa-home fa-fw fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Dashboard</span></a></li>
          <li><a href="<?php echo e(route('shared.faculty_class_schedules.index')); ?>"><i class="fa  fa-file-text-o fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Class Schedule</span></a></li>
          <li><a href="<?php echo e(route('admin.admission_information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Admission Information</span></a></li>
          <li><a href="<?php echo e(route('admin.faculty_information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Information</span></a></li>
          <li><a href="<?php echo e(route('admin.registrar_information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Registrar Information</span></a></li>
          <li><a href="<?php echo e(route('admin.finance_information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Finance Information</span></a></li>
          <li><a href="<?php echo e(route('admin.student.information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Information</span></a></li>
          <li><a href="<?php echo e(route('registrar.incoming_student')); ?>"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Incoming Student</span></a></li>
          <li><a href="<?php echo e(route('registrar.class_details')); ?>"><i class="fa fa-list-alt  fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Class Lists</span></a></li>
          <li>
            <a href="#">
              <i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; 
              <span>Student Sectioning</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            
              <ul class="treeview-menu">
                
                  <li><a href="<?php echo e(route('registrar.student_admission.grade7')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 7</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade8')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 8</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade9')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 9</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade10')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 10</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade11')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 11</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade12')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 12</span></a></li>
              </ul>
          </li>
          <li><a href="<?php echo e(route('admin.transcript_archieve')); ?>"><i class="fa fa-archive fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Transcript Archive</span></a></li>
          <li><a href="<?php echo e(route('admin.articles')); ?>"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>News and Events</span></a></li>

        <?php endif; ?>
        
        
        
        <?php if(Auth::user()->role == 3): ?>
          <li><a href="<?php echo e(route('registrar.dashboard')); ?>"><i class="fa fa-home fa-fw fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Dashboard</span></a></li>
          <li><a href="<?php echo e(route('registrar.incoming_student')); ?>"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Incoming Student</span></a></li>
          <li><a href="<?php echo e(route('registrar.class_details')); ?>"><i class="fa fa-list-alt fa-lg "></i>&nbsp;&nbsp;&nbsp; <span>Class Lists</span></a></li>  
          <li>
            <a href="#">
              <i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; 
              <span>Student Sectioning</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            
              <ul class="treeview-menu">
                
                  <li><a href="<?php echo e(route('registrar.student_admission.grade7')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 7</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade8')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 8</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade9')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 9</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade10')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 10</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade11')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 11</span></a></li>
                  <li><a href="<?php echo e(route('registrar.student_admission.grade12')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Grade 12</span></a></li>
              </ul>
          </li>
          <li><a href="<?php echo e(route('shared.faculty_class_schedules.index')); ?>"><i class="fa fa-file-text-o fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Class Schedule</span></a></li>
          <li><a href="<?php echo e(route('admin.faculty_information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Faculty Information</span></a></li>
          <li><a href="<?php echo e(route('admin.student.information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Information</span></a></li>           
        <?php endif; ?>
        
        
        <?php if(Auth::user()->role == 4): ?>
          <li><a href="<?php echo e(route('faculty.dashboard')); ?>"><i class="fa fa-home fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;Dashboard</a></li>
          <li><a href="<?php echo e(route('faculty.subject_class')); ?>"><i class="fa fa-sticky-note-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Subject Class</span></a></li>
          <li><a href="<?php echo e(route('faculty.faculty_class_schedules')); ?>"><i class="fa fa-file-text-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Faculty Class Schedules</span></a></li>
          <li><a href="<?php echo e(route('faculty.student_grade_sheet')); ?>"><i class="fa fa-pencil-square-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Encode Student Grades</span></a></li>
          
          
          <li><a href="<?php echo e(route('faculty.class-attendance.index')); ?>"><i class="fa fa-calendar-plus-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Encode Class Attendance</span></a></li>
          <li><a href="<?php echo e(route('faculty.encode-remarks.index')); ?>"><i class="fa fa-pencil-square-o fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Print Class Card</span></a></li>
          <li><a href="<?php echo e(route('faculty.class_demographic_profile.index')); ?>"><i class="fa fa-info-circle fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>Demographic Profile</span></a></li>
          <li><a href="<?php echo e(route('faculty.advisory_class.index')); ?>"><i class="fa fa-users fa-lg"></i> &nbsp;&nbsp;&nbsp;<span>My Advisory Class</span></a></li>
          
          
            
          </li>
        <?php endif; ?>

        <?php if(Auth::user()->role == 7): ?>
          <li><a href="<?php echo e(route('admission.dashboard')); ?>"><i class="fa fa-home fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;Dashboard</a></li>
          <li><a href="<?php echo e(route('registrar.incoming_student')); ?>"><i class="fas fa-users fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Incoming Student</span></a></li>
          <li><a href="<?php echo e(route('admin.student.information')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Information</span></a></li>    
        <?php endif; ?>
        
          
        <?php if(Auth::user()->role == 1 || Auth::user()->role == 0): ?>
          <li class="treeview">
              <a href="#">
                <i class="fa fa-cog fa-lg"></i>&nbsp;&nbsp;&nbsp; 
                <span>Maintenance</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                  
                  <li><a href="<?php echo e(route('admin.maintenance.school_year')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>School Year</span></a></li>
                  <li><a href="<?php echo e(route('admin.maintenance.semester')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Semester</span></a></li>
                  <li><a href="<?php echo e(route('admin.maintenance.strand')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Strands</span></a></li>
                  <li><a href="<?php echo e(route('admin.maintenance.subjects')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Subjects</span></a></li>
                  <li><a href="<?php echo e(route('admin.maintenance.classrooms')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Class Rooms</span></a></li>
                  <li><a href="<?php echo e(route('admin.maintenance.section_details')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Section Details</span></a></li>
                  <li><a href="<?php echo e(route('admin.maintenance.date_remarks_for_class_card')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Date of Remarks</span></a></li>
                  
                  
              </ul>
          </li>
        <?php endif; ?>

        
        <?php if(Auth::user()->role == 6): ?>
          <li><a href="<?php echo e(route('finance.dashboard')); ?>"><i class="fa fa-home fa-fw fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Dashboard</span></a></li>
          
          <li><a href="<?php echo e(route('finance.student_payment')); ?>">&nbsp;<i class="fas fa-clipboard-list fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Payment </i>
          
          </span></a></li>
          <li><a href="<?php echo e(route('finance.student_acct')); ?>"> <i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Student Account</span></a></li>
          <li><a href="<?php echo e(route('finance.summary')); ?>"><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Payment Summary</span></a></li>
          <li><a href="<?php echo e(route('finance.online_appointment.date_time')); ?>"><i class="far fa-calendar-check fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>Online Appointment</span></a></li>
          
          
          <li>
            <a href="#">
              <i class="fa fa-cog fa-lg ">
              </i>&nbsp;&nbsp;&nbsp; 
              <span>Maintenance</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i><span class="label label-primary pull-right">5</span></span>
              
            </a>
            <ul class="treeview-menu menu-open" style="display: block">
                <li><a href="<?php echo e(route('finance.maintenance.tuition_fee')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Tuition Fee</span></a></li>
                <li><a href="<?php echo e(route('finance.maintenance.downpayment')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Downpayment Fee</span></a></li>
                <li><a href="<?php echo e(route('finance.maintenance.misc_fee')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Miscellaneous Fee</span></a></li>                
                <li><a href="<?php echo e(route('finance.maintenance.disc_fee')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Discount</span></a></li>
                <li><a href="<?php echo e(route('finance.maintenance.payment_category')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Payment Category</span></a></li>
                <li><a href="<?php echo e(route('finance.maintenance.other_fee')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Other Fee</span></a></li>
                <li><a href="<?php echo e(route('finance.maintenance.queue')); ?>"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp; <span>Online Appointment Set-up</span></a></li>
            </ul>
          </li>   
        <?php endif; ?>
        <li>
          <?php if(Auth::user()->role == 3): ?>
            <a href="<?php echo e(route('registrar.my_account.index')); ?>"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a></li>
          <?php elseif(Auth::user()->role == 4): ?>
            <a href="<?php echo e(route('faculty.my_account.index')); ?>"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a></li>
          <?php elseif(Auth::user()->role == 6): ?>
            <a href="<?php echo e(route('finance.my_account.index')); ?>"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a></li>
          <?php elseif(Auth::user()->role == 7): ?>
            <a href="<?php echo e(route('admission.my_account.index')); ?>"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a></li>
          <?php elseif(Auth::user()->role == 0 || Auth::user()->role == 1): ?>
            <a href="<?php echo e(route('my_account.index')); ?>"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp; <span>My Account</span></a></li>
          <?php endif; ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $__env->yieldContent('content_title'); ?>
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
            <?php echo $__env->yieldContent('content'); ?>
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php echo $__env->make('control_panel.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>