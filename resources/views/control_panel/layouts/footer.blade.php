
<div class="js-modal_holder"></div>
  <footer class="main-footer">
    <strong>Copyright &copy; {{$year}} <a href="#">St. John's Academy Inc</a>.</strong> 
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1
    </div>                  
  </footer>
</div>
<!-- ./wrapper -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="{{ asset('js/control_panel.js') }}"></script>
@yield('scripts')
	<script>
		function loader_overlay($target_class = '') {
		if (!$target_class) {
			if ($('#js-loader-overlay').hasClass('d-none')) {
				$('#js-loader-overlay').removeClass('d-none')
			} else {
				$('#js-loader-overlay').addClass('d-none')
			}
		} else {
			if ($('#' + $target_class).hasClass('d-none')) {
				$('#' + $target_class).removeClass('d-none')
			} else {
				$('#' + $target_class).addClass('d-none')
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
</body>
</html>