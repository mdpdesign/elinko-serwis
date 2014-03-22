@extends('layouts.default')

@section('content')
	
	<div class="login-wrapper">
		<h2 class="form-signin-heading company-logo"><span class="icon icon-elinko"></span></h2>

		{{ Form::open(array('url'=>'login', 'class'=>'form-signin', 'role' => 'form')) }}
		
		<div class="form-group">
		{{ Form::label('email', 'Adres e-mail') }}
		{{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Wpisz adres email')) }}
		</div>

		<div class="form-group">
		{{ Form::label('email', 'Hasło') }}
		{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Wpisz hasło')) }}
		</div>

		{{ Form::submit('Zaloguj', array('class'=>'btn btn-lg btn-primary btn-block'))}}
		{{ Form::close() }}
	</div>

@stop