@extends('layouts.admin')

@section('content')
<div class="errors row">
	<div class="col-md-12">
	
		@if ($errors->any())
		<div class="alert alert-danger fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
			@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
			@endforeach
		</div>
		@endif
	
		<div class="page-header">
			<h3 class="text-danger">{{ trans('admin.message.order_list_empty') }}</h3>
		</div>
	</div>
</div>
@stop