
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

	<!-- Fonts CSS -->
	{{ HTML::style('css/font-elinko.css') }}

	<!-- Admin CSS -->
	{{ HTML::style('css/admin.css') }}

	@yield('styles')

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
			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">{{ trans('admin.message.switch_nav') }}</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="{{ route('admin') }}" class="navbar-brand"><span class="icon icon-elinko"></span></a>
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
									<li class="dropdown-header">{{ trans('admin.message.show_orders') }}</li>
									<li><a class="open-all" href="#">{{ trans('admin.message.show_all') }}</a></li>
									<li><a class="close-all" href="#">{{ trans('admin.message.hide_all') }}</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">{{ trans('admin.message.statistics') }}</li>
									<li><a href="{{ route('admin.orders.reports') }}">{{ trans('admin.message.show_statistics') }}</a></li>
								</ul>
							</li>
						</ul>
						
						{{ Form::open(['route' => 'admin.orders.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search']) }}
							<div class="form-group">
								{{ Form::text('search', null, ['class' => 'navbar-search form-control', 'placeholder' => 'Szukaj']) }}
							</div>
							{{ Form::button('Szukaj', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
						{{ Form::close() }}

						<ul class="nav navbar-nav navbar-right">
							
							@if (Auth::user()->hasRole('Administrator'))
								<li><a href="{{ route('admin.settings.index') }}" class="admin-tooltip", data-toggle="tooltip" data-placement="bottom" title="{{ trans('Zmień ustawienia aplikacji') }}"><span class="glyphicon glyphicon-dashboard"></span><span class="hidden-sm hidden-md">&nbsp;{{ trans('admin.message.settings') }}</span></a></li>
							@endif

							<li><a href="{{ route('admin.userprofile.show', App::make('SerwisHelper')->authUserId()) }}" class="admin-tooltip", data-toggle="tooltip" data-placement="bottom" title="{{ trans('admin.message.edit_user') }}"><span class="glyphicon glyphicon-user"></span><span class="hidden-sm hidden-md">&nbsp;{{ App::make('SerwisHelper')->authUserFullName() }}</span></a>
							<li><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-off"></span>&nbsp;{{ trans('admin.message.logout') }}</a></li>	
						</ul>
					</div><!--/.nav-collapse -->
				</div>
				<div class="navborder bar-1"></div>
				<div class="navborder bar-2"></div>
				<div class="navborder bar-3"></div>
			</div>

			<div class="container">

				@include('notifications')
				@yield('content')
				@include('partials.credits')

			</div> <!-- /container -->
			
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

		@yield('footer-scripts')

		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/admin-init.js') }}
	</body>
	</html>
