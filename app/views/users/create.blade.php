@extends('layouts.admin')

@section('content')
<div class="row">
	{{ Form::open(['route' => 'admin.settings.users.store']) }}
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
			{{ Form::label('password', trans('admin.message.new_password')) }}
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.new_password_pl'))) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('role', trans('admin.message.user_role')) }}
			{{ Form::select('role', $role, null, ['class' => 'form-control']) }}
			{{-- Form::select('role', null, array('class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.user_firstname_pl'))) --}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{ Form::submit(trans('admin.message.buttons.save'), array('class' => 'btn btn-primary')) }}		
	</div>
	{{ Form::close() }}
</div>
@stop