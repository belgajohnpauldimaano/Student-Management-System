<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel | @yield('content_title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->

  <link rel="stylesheet" href="{{ asset('cms-new/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Font Awesome -->
 
    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/select2/css/select2.min.css') }}">
  
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

  <link href="{{ asset('favicon.png') }}" rel=icon>

  <link href="{{ asset('img/sja-logo.png') }}" rel=icon>

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
    
  </style>
  @yield('styles')
</head>