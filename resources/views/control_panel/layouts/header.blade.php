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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">  
  <link href="{{ asset('favicon.png') }}" rel=icon>
  <link href="{{ asset('img/sja-logo.png') }}" rel=icon>

  <link rel="stylesheet" href="{{ asset('css/control_panel.css') }}">
  <link rel="stylesheet" href="{{ asset('cms-new/plugins/fontawesome-free/css/all.min.css') }}">
  
  
  @yield('styles')
</head>