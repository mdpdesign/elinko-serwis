@extends('layouts.admin')

@section('styles')
{{ HTML::style('css/vendor/owl-carousel/owl.carousel.css') }}
{{ HTML::style('css/vendor/owl-carousel/owl.theme.css') }}

<style>
#history {
	margin-bottom: 1em;
}
.history-title {
	display: none;
	margin-bottom: 1em;
}
#history .history-item {
	margin: 0;
}
.history-item .date {
}
.history-item .event {
	background-color: #5C6063;
	color: lightblue;
	padding: 5px;
	margin-left: 5px;
	margin-right: 5px;
	text-align: left;

	-webkit-border-radius: 3px;
	-webkit-border-top-left-radius: 0;
	-moz-border-radius: 3px;
	-moz-border-radius-topleft: 0;
	border-radius: 3px;
	border-top-left-radius: 0;
}
.history-item p, .history-item h5 {
	margin: 0;
}
.history-item h5 {
	padding-left: 10px;
}
.history-item hr {
	margin-top: 5px;
	margin-bottom: 0;
	border-top: 1px solid #E4E4E4;
}

.triangle-bottomleft {
	margin-left: 5px;
	width: 0;
	height: 0;
	border-bottom: 10px solid #5C6063;
	border-right: 10px solid transparent;
}
</style>

@stop

@section('footer-scripts')
{{ HTML::script('js/vendor/owl-carousel/owl.carousel.min.js') }}
{{ HTML::script('js/owl-show-history.js') }}
@stop

@section('content')
{{ Form::model($order) }}
<div class="row">

	<div class="col-md-12">
		<div class="page-header">
			<h3>{{ trans('admin.message.order_show_title') }} <strong>{{ $order->rma_number }}</strong></h3>
			<h4>{{ $order->history->first()->created_at . ' ' . $order->history->first()->event }}</h4>
		</div>
	</div>

	<div class="col-md-6">
		
		<div class="row">
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('status_id', trans('admin.message.order_status')) }}
					{{ Form::select('status_id', $statuses, null, ['disabled', 'class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('branch_id', trans('admin.message.order_branch')) }}
					{{ Form::select('branch_id', $branches, null, ['disabled', 'class' => 'form-control']) }}
				</div>
			</div>
		</div>

		<div class="input-row">
			{{ Form::label('item', trans('admin.message.order_item')) }}
			{{ Form::text('item', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_item_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::label('description', trans('admin.message.order_description')) }}
			{{ Form::textarea('description', null, ['readonly', 'class' => 'form-control', 'rows' => 4, 'placeholder' => trans('admin.message.placeholders.order_description_pl')]) }}
		</div>

		<div class="row">
			<div class="col-md-7">
				<div class="input-row">
					{{ Form::label('serial_number', trans('admin.message.order_serial_number')) }}
					{{ Form::text('serial_number', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_serial_number_pl')]) }}
				</div>
			</div>
			
			<div class="col-md-5">
				<div class="input-row">
					{{ Form::label('pa_fv', trans('admin.message.order_document')) }}
					{{ Form::text('pa_fv', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_document_pl')]) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('client', trans('admin.message.order_client')) }}
					{{ Form::text('client', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_client_pl')]) }}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('client_phone', trans('admin.message.order_client_phone')) }}
					{{ Form::text('client_phone', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_client_phone_pl')]) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="input-row">
					{{ Form::label('user_id', trans('admin.message.order_creator')) }}
					{{ Form::select('user_id', $users_list, null, ['disabled', 'class' => 'form-control']) }}
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-6">

		<div class="row">
			<div class="col-md-6">
				<div class="input-row">
					{{ Form::label('ext_service', trans('admin.message.order_ext_service')) }}
					{{ Form::text('ext_service', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_ext_service_pl')]) }}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<div class="input-row">
							{{ Form::label('price_netto', trans('admin.message.order_price_netto')) }}
							<div class="input-group">
								{{ Form::text('price_netto', null, ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_price_netto_pl')]) }}
								<span class="input-group-addon">{{ trans('admin.message.order_price_netto_currency') }}</span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-row">
							{{ Form::label('price_brutto', trans('admin.message.order_price_brutto')) }}
							<div class="input-group">
								{{ Form::text('price_brutto', $order->calculateBrutto(), ['readonly', 'class' => 'form-control', 'placeholder' => trans('admin.message.placeholders.order_price_brutto_pl')]) }}
								<span class="input-group-addon">{{ trans('admin.message.order_price_netto_currency') }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="input-row">
			{{ Form::label('comments', trans('admin.message.order_comments')) }}
			{{ Form::textarea('comments', null, ['readonly', 'class' => 'form-control', 'rows' => 4, 'placeholder' => trans('admin.message.placeholders.order_comments_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::label('accesories', trans('admin.message.order_accessories')) }}
			{{ Form::textarea('accesories', null, ['readonly', 'class' => 'form-control', 'rows' => 3, 'placeholder' => trans('admin.message.placeholders.order_accessories_pl')]) }}
		</div>

		<div class="input-row">
			{{ Form::label('diagnose', trans('admin.message.order_diagnose')) }}
			{{ Form::textarea('diagnose', null, ['readonly', 'class' => 'form-control', 'rows' => 4, 'placeholder' => trans('admin.message.placeholders.order_diagnose_pl')]) }}
		</div>

		<div class="input-row">
			{{ link_to_route('admin.orders.edit', trans('admin.message.buttons.edit'), $order->id, array('class' => 'btn btn-primary')) }}

			@if (Auth::user()->hasRole('Administrator'))
			{{ HTML::link('#', trans('admin.message.buttons.delete'), ['class' => 'btn btn-primary btn-danger', 'data-toggle' => 'modal', 'data-target' => '#myModal']) }}
			@endif
			
			{{ link_to_route('admin.orders.index', trans('admin.message.buttons.back_to_list'), Input::old(), ['class' => 'btn btn-default']) }}
            <a href="{{ URL::route('admin.orders.print', $order->id) }}" target="_blank" class="btn-print-order btn btn-default"><span class="glyphicon glyphicon-print"></span></a>
            <a href="{{ URL::route('admin.orders.printlabel', $order->id) }}" target="_blank" class="btn-print-label btn btn-default"><span class="glyphicon glyphicon-barcode"></span></a>
		</div>

	</div>
</div>
{{ Form::close() }}

<div class="row">
	<div class="col-md-12"><hr></div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="history-panel">
			<h4 class="history-title">Historia zlecenia:</h4>
			<div id="history" class="owl-carousel">
				@foreach ( $order->history->reverse() as $history )
				<div class="history-item">
					<div class="date">
						<h5>{{ $history->created_at }}</h5>
						<hr>
					</div>
					<div class="event-wrapper">
						<div class="triangle-bottomleft"></div>
						<div class="event">
							<p>{{ $history->event }}</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::model( $order, array( 'id' => 'form-delete-confirm', 'method' => 'DELETE', 'route' => array('admin.orders.destroy', $order->id))) }}
        <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">{{ trans('admin.message.order_delete_title_single', ['rma' => $order->rma_number]) }}</h4>
			</div>
			<div class="modal-body">
				<p>{{ trans('admin.message.order_delete_message_single', ['rma' => $order->rma_number]) }}</p>
			</div>
			<div class="modal-footer">
				{{ Form::button('Anuluj', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) }}
				{{ Form::submit('Usuń', ['class' => 'btn btn-primary btn-danger'])}}
			</div>
		</div>
	</div>
        {{ Form::close() }}
</div>
@stop