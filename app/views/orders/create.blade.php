@extends('layouts.admin')

@section('content')
{{ Form::open(['route' => 'admin.orders.store']) }}
<div class="row">

	<div class="col-md-12">
		<div class="page-header">
			<h3>Dodaj nowe zlecenie</strong></h3>
			<h4>Uzupełnij wszystkie dane</h4>
		</div>
	</div>

	<div class="col-md-6">
		
		<div class="row">
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('status_id', trans('admin.message.order_status')) }}
					{{ Form::select('status_id', $statuses, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('branch_id', trans('admin.message.order_branch')) }}
					{{ Form::select('branch_id', $branches, null, ['class' => 'form-control']) }}
				</div>
			</div>
		</div>

		<div class="input-row">
			{{ Form::label('item', trans('admin.message.order_item')) }}
			{{ Form::text('item', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_item_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::label('description', trans('admin.message.order_description')) }}
			{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => trans('admin.message.placeholders.order_description_pl')]) }}
		</div>

		<div class="row">
			<div class="col-md-7">
				<div class="input-row">
					{{ Form::label('serial_number', trans('admin.message.order_serial_number')) }}
					{{ Form::text('serial_number', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_serial_number_pl')]) }}
				</div>
			</div>
			
			<div class="col-md-5">
				<div class="input-row">
					{{ Form::label('pa_fv', trans('admin.message.order_document')) }}
					{{ Form::text('pa_fv', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_document_pl')]) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('client', trans('admin.message.order_client')) }}
					{{ Form::text('client', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_client_pl')]) }}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('client_phone', trans('admin.message.order_client_phone')) }}
					{{ Form::text('client_phone', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_client_phone_pl')]) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="input-row">
					{{ Form::label('user_id', trans('admin.message.order_creator')) }}
					{{ Form::select('user_id', $users_list, null, ['class' => 'form-control']) }}
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-6">

		<div class="row">
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('ext_service', trans('admin.message.order_ext_service')) }}
					{{ Form::text('ext_service', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_ext_service_pl')]) }}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('price_netto', trans('admin.message.order_price_netto')) }}
					<div class="input-group">
						{{ Form::text('price_netto', null, ['class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_price_netto_pl')]) }}
						<span class="input-group-addon">{{ trans('admin.message.order_price_netto_currency') }}</span>
					</div>
				</div>
			</div>
		</div>
		
		<div class="input-row">
			{{ Form::label('comments', trans('admin.message.order_comments')) }}
			{{ Form::textarea('comments', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => trans('admin.message.placeholders.order_comments_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::label('accesories', trans('admin.message.order_accessories')) }}
			{{ Form::textarea('accesories', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => trans('admin.message.placeholders.order_accessories_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::label('diagnose', trans('admin.message.order_diagnose')) }}
			{{ Form::textarea('diagnose', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => trans('admin.message.placeholders.order_diagnose_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::submit(trans('admin.message.buttons.save'), ['class' => 'btn btn-primary']) }}
		</div>

	</div>
</div>
{{ Form::close() }}
@stop