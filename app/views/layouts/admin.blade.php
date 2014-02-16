
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

	<title>{{ trans('admin.message.page_title') }}</title>

	<!-- Bootstrap core CSS -->
	{{ HTML::style('css/bootstrap.css') }}

	<!-- Admin CSS -->
	{{ HTML::style('css/admin.css') }}

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>{{ HTML::script('js/ie8-responsive-file-warning.js') }}<![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>

		<body>

			<!-- Fixed navbar -->
			<div class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Przełącz nawigację</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						{{ link_to_route('admin', trans('admin.message.appname'), null, array('class' => 'navbar-brand')) }}
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li>{{ link_to_route('admin.orders.index', trans('admin.message.linklabels.orders_home_list')) }}</li>
							<li><a href="{{ route('admin.orders.create') }}"><span class="glyphicon glyphicon-plus"></span>&nbsp;{{ trans('admin.message.linklabels.orders_add') }}</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('admin.message.linklabels.orders_home') }}<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{ route('admin.orders.index') }}"><span class="glyphicon glyphicon-th-list"></span>&nbsp;{{ trans('admin.message.linklabels.orders_home_list') }}</a></li>
									<li><a href="{{ route('admin.orders.create') }}"><span class="glyphicon glyphicon-plus"></span>&nbsp;{{ trans('admin.message.linklabels.orders_add') }}</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">Pokaż zlecenia:</li>
									<li><a class="open-all" href="#">Rozwiń wszystkie</a></li>
									<li><a class="close-all" href="#">Zwiń wszystkie</a></li>
								</ul>
							</li>
						</ul>
						
						{{ Form::open(['route' => 'admin.orders.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) }}
							<div class="form-group">
								{{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Szukaj']) }}
							</div>
							{{ Form::button('Szukaj', ['type' => 'submit', 'class' => 'btn btn-default']) }}
						{{ Form::close() }}

						<ul class="nav navbar-nav navbar-right">
							<li class=""><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-off"></span> Wyloguj</a></li>
						</ul>
						<p class="navbar-text navbar-right"><strong>{{ trans('admin.message.logged_as') }}</strong><span class="glyphicon glyphicon-user"></span>&nbsp;{{ link_to_route('admin.users.index', $user->firstname .' '. $user->lastname, null, array('class' => 'admin-tooltip', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'title' => trans('admin.message.edit_user'))) }}</p>
					</div><!--/.nav-collapse -->
				</div>
			</div>

			<div class="container">

				@include('notifications')
				@yield('content')

				<div class="row credits">
					<div class="-col-md-12">
						Projekt i wykonanie <a href="http://www.mdpdesign.pl">mdpdesign.pl</a> &copy; {{ date('Y') }}
					</div>
				</div>

			</div> <!-- /container -->
			
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/admin-init.js') }}
	</body>
	</html>
