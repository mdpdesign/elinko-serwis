
@if (Session::has('message'))
<div class="alert alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
	<p>{{ Session::get('message') }}</p>
</div>
@endif

@if (Session::has('info'))
<div class="alert alert-info fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
	<p>{{ Session::get('info') }}</p>
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
	<p>{{ Session::get('success') }}</p>
</div>
@endif

@if (Session::has('errors'))
<div class="alert alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
	@foreach($errors->all() as $error)
	<p>{{ $error }}</p>
	@endforeach
</div>
@endif