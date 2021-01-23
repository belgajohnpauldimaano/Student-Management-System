<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>St. John's Academy Inc. Admin Panel | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {{-- <link rel="stylesheet" href="{{ asset('cms/bootstrap/css/bootstrap.min.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('cms-new/plugins/fontawesome-free/css/all.min.css')}}">

  <link rel="stylesheet" href="{{ asset('cms-new/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  {{-- <link rel="stylesheet" href="{{ asset('cms/dist/css/AdminLTE.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('cms-new/dist/css/adminlte.min.css') }}">
  <!-- iCheck -->
  {{-- <link rel="stylesheet" href="{{ asset('cms/plugins/iCheck/square/blue.css') }}"> --}}

  <link href="{{ asset('img/sja-logo.png') }}" rel=icon>
  <style>
        .loader {
            display: block;
            margin: 20px auto 0;
            vertical-align: middle;
        }

        #preloader {
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.63);
            z-index: 11000;
            position: fixed;
            display: block;
        }

        .preloader {
            position: absolute;
            margin: 0 auto;
            left: 1%;
            right: 1%;
            top: 47%;
            width: 100px;
            height: 100px;
            background: center center no-repeat none;
            background-size: 65px 65px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
        }
        .global-header__block {
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.58);
            /* color: #fff; */
        }
</style>   
  @yield('styles')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
<div class="global-header__block">
  <div class="login-box m-auto" style="margin-top: 150px !important">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ route('home_page') }}" class="h2">
          <div class="row">
            <div class="col-4"><img src="{{ asset('/img/sja-logo.png') }}"  class="brand-image img-circle elevation-3" style="height: 80px"></div>
            <div class="col-8 text-left "><b>St. John's </b><br/>Academy Inc.</div>
          </div>
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">
          Sign in to start your session
        </p>
        @yield('content')
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

{{-- <!-- jQuery 2.2.3 -->
<script src="{{ asset('cms/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('cms/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('cms/plugins/iCheck/icheck.min.js') }}"></script> --}}
{{-- <script src="{{ asset('cms/plugins/jQuery/jquery-2.2.3.min.js') }}"></script> --}}
<script src="{{ asset('cms-new/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('cms-new/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('cms-new/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('cms-new/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@yield('scripts')
</body>
</html>
