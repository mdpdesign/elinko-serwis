@extends('layouts.admin')

@section('content')
<div class="row">
	{{ Form::model($user, array('method' => 'PATCH', 'route' => array('admin.userprofile.update', Session::get('current_user_id')))) }}
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('firstname', trans('admin.message.user_firstname')) }}
			{{ Form::text('firstname', null, array('readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.user_firstname_pl'))) }}
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('lastname', trans('admin.message.user_lastname')) }}
			{{ Form::text('lastname', null, array('readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.user_lastname_pl'))) }}
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('email', trans('admin.message.user_email')) }}
			{{ Form::email('email', null, array('readonly', 'class'=>'form-control', 'placeholder' => trans('admin.message.placeholders.user_email_pl'))) }}
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-row">
			{{ Form::label('updated_at', trans('admin.message.user_updated_at')) }}
			{{ Form::text('updated_at', null, array('readonly', 'class' => 'form-control')) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{ link_to_route('admin.userprofile.edit', trans('admin.message.buttons.edit'), array($user->id), array('class' => 'btn btn-primary', 'title' => trans('admin.message.edit_user'))) }}
	</div>
	{{ Form::close() }}
</div>
@stop