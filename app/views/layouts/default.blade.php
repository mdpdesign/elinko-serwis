
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

	<title>Zarządzanie serwisem - Elinko</title>

	<!-- Bootstrap core CSS -->
	{{ HTML::style('css/bootstrap.css') }}

	<!-- Custom styles for this template -->
	{{ HTML::style('css/signin.css') }}

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>{{ HTML::script('js/ie8-responsive-file-warning.js') }}<![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>

		<body>

			<div class="container">

			@include('notifications')
			
			@yield('content')

			</div> <!-- /container -->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		{{ HTML::script('js/bootstrap.min.js') }}
	</body>
	</html>