
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lumino - Dashboard</title>

		<link href="{{ url('') }}/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ url('') }}/css/font-awesome.min.css" rel="stylesheet">
		<link href="{{ url('') }}/css/datepicker3.css" rel="stylesheet">
		<link href="{{ url('') }}/datatable/datatables.min.css" rel="stylesheet">
		<link href="{{ url('') }}/css/styles.css" rel="stylesheet">

		<!--Theme Switcher-->
		<style id="hide-theme">
			body{
				display:none;
			}
		</style>
		<script type="text/javascript">
			function setTheme(name){
				var theme = document.getElementById('theme-css');
				var style = 'css/theme-' + name + '.css';
				if(theme){
					theme.setAttribute('href', style);
				} else {
					var head = document.getElementsByTagName('head')[0];
					theme = document.createElement("link");
					theme.setAttribute('rel', 'stylesheet');
					theme.setAttribute('href', style);
					theme.setAttribute('id', 'theme-css');
					head.appendChild(theme);
				}
				window.localStorage.setItem('lumino-theme', name);
			}
			var selectedTheme = window.localStorage.getItem('lumino-theme');
			if(selectedTheme) {
				setTheme(selectedTheme);
			}
			window.setTimeout(function(){
					var el = document.getElementById('hide-theme');
					el.parentNode.removeChild(el);
				}, 5);
		</script>
		<!-- End Theme Switcher -->


		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		@include('backend.layouts.nav')
		@include('backend.layouts.sidebar')
			
		@yield('content')
		
		<script src="{{ url('') }}/js/jquery-1.11.1.min.js"></script>
		<script src="{{ url('') }}/js/bootstrap.min.js"></script>
		<script src="{{ url('') }}/datatable/datatables.min.js"></script>
		<script src="{{ url('') }}/js/chart.min.js"></script>
		<script src="{{ url('') }}/js/chart-data.js"></script>
		<script src="{{ url('') }}/js/easypiechart.js"></script>
		<script src="{{ url('') }}/js/easypiechart-data.js"></script>
		<script src="{{ url('') }}/js/bootstrap-datepicker.js"></script>
		<script src="{{ url('') }}/js/custom.js"></script>
		@stack('scripts')
			
	</body>

</html>