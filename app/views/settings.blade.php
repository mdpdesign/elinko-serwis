@extends('layouts.admin')

@section('content')
	<div class="row">

		<div class="col-md-12 settings-header">
			<div class="page-header">
				<h3>{{ trans('admin.message.app_settings') }} <small>{{ trans('admin.message.actual_date') }} {{ date('d-m-Y') }}</small> </h3>
			</div>
		</div><!-- .naglowek -->

		<div class="col-md-6 left-column">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ trans('admin.message.manage_users') }}</h3>
				</div>
				<div class="panel-body">

					<div class="user-table-buttons clearfix">
						 <a href="{{ route('admin.settings.users.create') }}" class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;{{ trans('admin.message.add_new_user') }}</a>
					</div>
					
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>{{ trans('admin.message.user_firstname') }}</th>
									<th>{{ trans('admin.message.user_lastname') }}</th>
									<th>{{ trans('admin.message.user_email') }}</th>
									<th>{{ trans('admin.message.user_role') }}</th>
									<th>{{ trans('admin.message.buttons.edit') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users->all() as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->firstname }}</td>
									<td>{{ $user->lastname }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->roles->first()->name }}</td>
									<td><a href="{{ route('admin.settings.users.show', $user->id) }}" class="btn btn-default btn-xs">{{ trans('admin.message.buttons.show') }}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div><!-- .lewa kolumna -->

		<div class="col-md-6 right-column">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Panel title</h3>
				</div>
				<div class="panel-body">
					Panel content
				</div>
			</div>
		</div><!-- .prawa kolumna -->

	</div>
@stop