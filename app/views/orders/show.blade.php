@extends('layouts.admin')

@section('content')
{{ Form::model($order) }}
<div class="row">

	<div class="col-md-12">
		<div class="page-header">
			<h3>{{ trans('admin.message.order_show_title') }} <strong>{{ $order->rma_number }}</strong></h3>
			<h4>{{ $order->history->last()->created_at . ' ' . $order->history->last()->event }}</h4>
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
			{{ HTML::link('#', trans('admin.message.buttons.delete'), ['class' => 'btn btn-primary btn-danger', 'data-toggle' => 'modal', 'data-target' => '#myModal']) }}
            {{ link_to_route('admin.orders.index', trans('admin.message.buttons.back_to_list'), Input::except('search'), ['class' => 'btn btn-primary']) }}
            <a href="{{ URL::route('admin.orders.print', $order->id) }}" target="_blank" class="btn-print-order btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>
            <a href="{{ URL::route('admin.orders.printlabel', $order->id) }}" target="_blank" class="btn-print-label btn btn-primary"><span class="glyphicon glyphicon-barcode"></span></a>
		</div>

	</div>
</div>
{{ Form::close() }}

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Historia zlecenia</a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
      	<ul class="history">
        @foreach ( $order->history->reverse() as $history )
        	<li>{{ $history->created_at }} {{ $history->event }}</li>
        @endforeach
        </ul>
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
				<h4 class="modal-title" id="myModalLabel">{{ trans('admin.message.order_delete_title') }}</h4>
			</div>
			<div class="modal-body">
				<p>{{ trans('admin.message.order_delete_message') }}</p>
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