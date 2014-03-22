@extends('layouts.admin')

@section('content')
<div class="row">
	{{ Form::model($user, array('method' => 'PATCH', 'route' => array('admin.userprofile.update', $user->id))) }}
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('firstname', trans('admin.message.user_firstname')) }}
			{{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.user_firstname_pl'))) }}
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('lastname', trans('admin.message.user_lastname')) }}
			{{ Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.user_lastname_pl'))) }}
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('email', trans('admin.message.user_email')) }}
			{{ Form::email('email', null, array('class'=>'form-control', 'placeholder' => trans('admin.message.placeholders.user_email_pl'))) }}
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('password', trans('admin.message.edit_password')) }}
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.new_password_edit_pl'))) }}
		</div>
	</div>
</div>

@if ( isset($can_edit_roles) )
<div class="row">
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('role', trans('admin.message.user_role')) }}
			{{ Form::select('role', $roles, $user->roles->first()->id, ['class' => 'form-control']) }}
		</div>
	</div>
</div>
@endif

<div class="row">
	<div class="col-md-12">
		{{ Form::submit(trans('admin.message.buttons.save'), array('class' => 'btn btn-primary')) }}
		@if (Auth::user()->can('manage_users'))
		{{ link_to_route('admin.settings.users.show', trans('admin.message.buttons.cancel'), $user->id, array('class' => 'btn btn-primary')) }}
		@else
		{{ link_to_route('admin.userprofile.show', trans('admin.message.buttons.cancel'), App::make('SerwisHelper')->authUserId(), array('class' => 'btn btn-primary')) }}
		@endif
	</div>
	{{ Form::close() }}
</div>
@stop