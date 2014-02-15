@extends('layouts.default')

@section('content')

		{{ Form::open(array('url'=>'login', 'class'=>'form-signin', 'role' => 'form')) }}
		<h2 class="form-signin-heading">Logowanie</h2>

		{{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Adres email')) }}
		{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Hasło')) }}

		{{ Form::submit('Zaloguj', array('class'=>'btn btn-lg btn-primary btn-block'))}}
		{{ Form::close() }}

@stop