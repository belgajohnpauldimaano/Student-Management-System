<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel | @yield('content_title')</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" 
  integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('cms/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cms/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('cms/dist/css/skins/_all-skins.min.css') }}">

  <link href="{{ asset('favicon.png') }}" rel=icon>

  <link href="{{ asset('img/sja-logo.png') }}" rel=icon>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="{{ asset('cms/plugins/dropzone/min/dropzone.min.css') }}">
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
  </style>
  @yield('styles')
</head>
<body>
    <div class="container">
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

                <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may <a href="#" onclick="window.close()">return to dashboard</a> or try using the search form.
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    </div>


<!-- jQuery 2.2.3 -->
<script src="{{ asset('cms/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

<script src="{{ asset('cms/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('cms/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('cms/plugins/select2/select2.min.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('cms/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('cms/dist/js/app.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('cms/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('cms/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('cms/plugins/chartjs/Chart.min.js') }}"></script>

<script src="{{ asset('cms/plugins/bootbox/bootbox.min.js') }}"></script>

<script src="{{ asset('cms/plugins/alertifyjs/alertify.min.js') }}"></script>
<!-- jquery-toast-plugin -->
<script src="{{ asset('cms/plugins/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<!-- alertifyjs -->
<script src="{{ asset('cms/plugins/alertifyjs/alertify.min.js') }}"></script>
@yield('scripts')

<script>
    function loader_overlay($target_class = '') {
		if (!$target_class) {
			if ($('#js-loader-overlay').hasClass('hidden')) {
				$('#js-loader-overlay').removeClass('hidden')
			} else {
				$('#js-loader-overlay').addClass('hidden')
			}
		} else {
			if ($('#' + $target_class).hasClass('hidden')) {
				$('#' + $target_class).removeClass('hidden')
			} else {
				$('#' + $target_class).addClass('hidden')
			}
		}
    }
        
		/*
		 * @Function 	: show_toast_alert
		 * @Params  	: data - Object
		 *
		 * @Possible Param Object Content 
		 *		heading - a text that appears on the top of toast message, message - message body of toast,
		 *		type - type of message to be displayed (error, success, warning, info)
		 *	
		 * @Desc 		: this function will send request to server to save data
		 *
		 * {{-- @Created by : Paul Belga --}}
		 */
		function show_toast_alert(data) {
			$.toast({
				heading: data.heading,
				text: data.message,
				icon: data.type,
				showHideTransition: 'fade',
				loader: false,        // Change it to false to disable loader
				loaderBg: '#9EC600'  // To change the background
			})
		}
</script>
<script>
    function close_window(url){
        var newWindow = window.open('', '_self', ''); //open the current window
        window.close(url);
    }
</script>
</body>
</html>
