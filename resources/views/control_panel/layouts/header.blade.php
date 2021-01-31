<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel | @yield('content_title')</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {{-- <link rel="stylesheet" href="{{ asset('cms/bootstrap/css/bootstrap.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> --}}
    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" 
  integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous"> --}}
  <!-- jvectormap -->
  {{-- <link rel="stylesheet" href="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/select2/css/select2.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('cms/dist/css/AdminLTE.min.css') }}"> --}}
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/jqvmap/jqvmap.min.css') }}">  
  {{-- new theme --}}
  <link rel="stylesheet" href="{{ asset('cms-new/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cms-new/dist/css/adminlte.min.css.map') }}">
  {{-- <link rel="stylesheet" href="{{ asset('cms-new/plugins/css/adminlte.min.css') }}"> --}}
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.css') }}">


  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  {{-- <link rel="stylesheet" href="{{ asset('cms/dist/css/skins/_all-skins.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('cms/dist/css/skins/_all-skins.min.css') }}"> --}}

  <link href="{{ asset('favicon.png') }}" rel=icon>

  <link href="{{ asset('img/sja-logo.png') }}" rel=icon>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/dropzone/min/dropzone.min.css') }}">

  <link href="{{ asset('cms/plugins/alertifyjs/css/alertify.min.css') }}" rel="stylesheet">
  <link href="{{ asset('cms/plugins/alertifyjs/css/themes/bootstrap.min.css') }}" rel="stylesheet">
  <!-- jquery-toast-plugin -->
	<link rel="stylesheet" href="{{ asset('cms/plugins/jquery-toast-plugin/jquery.toast.min.css') }}">
  <!-- alertifyjs -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/alertifyjs/css/alertify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cms/plugins/alertifyjs/css/themes/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cms/plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('cms/plugins/timepicker/jquery.timepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('cms/plugins/datetimepicker/datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('cms/style.css') }}">
  
  
  <style>
    .profile-user-img {
      margin: 0 auto;
      padding: 3px;
      border: 3px solid #d2d6de;
      vertical-align: middle;
      width: 100px !important;
      height: 100px !important;
      /* border-radius: 50%; */
    }

    .search-title .text-light{
      color:black !important;
    }
  </style>
  @yield('styles')
</head>