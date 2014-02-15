@extends('layouts.admin')

@section('content')

<div id="orders-header" class="row">
	<div class="col-md-12">
		<div class="page-header">
			@if (isset($search)) 
			<h2>{{ 'Wyniki wyszukiwania dla słowa: "' . $search . "\"" }}</h2>
			@endif
			<h3>{{ trans('admin.message.order_list') }} <small>Aktualna data: {{ date('d-m-Y') }}</small> </h3>
		</div>
	</div>
</div> <!-- #orders-header  -->

<div id="filter-form" class="row">
	{{ Form::open(['method' => 'GET', 'route' => 'admin.orders.index', 'class' => 'form-inline', 'role' => 'form']) }}
	<div class="col-md-12">
		<div class="input-row">
			<span class="input-inline">
				{{ Form::label('status', 'Status') }}
				{{ Form::select('status', (['' => 'Wszystkie'] + $statuses), Input::get('status', ''), ['class' => 'form-control input-sm']) }}
			</span>
			<span class="input-inline">
				{{ Form::label('branch', 'Oddział') }}
				{{ Form::select('branch', (['' => 'Wszystkie'] + $branches), Input::get('branch', ''), ['class' => 'form-control input-sm']) }}
			</span>
			<span class="input-inline">
				{{ Form::label('order', 'Kolejność') }}
				{{ Form::select('order', ['DESC' => 'Od najnowszych', 'ASC' => 'Od najstarszych'], Input::get('order'), ['class' => 'form-control input-sm']) }}
			</span>
			<span class="input-inline">
				{{ Form::label('perpage', 'Wyników na stronie') }}
				{{ Form::select('perpage', ['10' => '10', '20' => '20', '30' => '30', '50' => '50', '100' => '100'], Input::get('perpage', '20'), ['class' => 'form-control input-sm']) }}
			</span>
			<span class="input-inline">
				{{ Form::submit('Pokaż', ['class' => 'btn btn-default btn-sm']) }}
			</span>
		</div>
	</div>
	{{ Form::close() }}
</div> <!-- #filter-form  -->

<div id="orders-table" class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			{{ Form::open(['method'=>'PATCH', 'action' => 'OrderController@massEdit']) }}
			<table class="rma-table table table-striped">
				<thead>
					<tr>
						<th class="id-column">{{ trans('admin.message.order_id') }}</th>
						<th class="id-checkbox">{{ Form::checkbox('id-all', null, null, ['id' => 'check-all']) }}</th>
						<th class="status">
							{{ trans('admin.message.order_status') }}
						</th>
						<th class="rma">{{ trans('admin.message.order_rma') }}</th>
						<th class="item">{{ trans('admin.message.order_item') }}</th>
						<th class="client">
							{{ trans('admin.message.order_client') }}
							{{-- link_to_route('admin.orders.index', 'Klient', ['orderBy' => 'client']) --}}
						</th>
						<th class="phone">{{ trans('admin.message.order_client_phone') }}</th>
						<th class="branch">
							{{ trans('admin.message.order_branch') }}
							{{-- link_to_route('admin.orders.index', 'Oddział', ['orderBy' => 'branch_id']) --}}
						</th>
						<th class="edit"><div class="edit-cell">{{ trans('admin.message.order_edit') }}</div></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($orders as $order)
					<tr class="rma-table-heading">
						<td><strong>{{ $order->id }}</strong></td>
						<td>{{ Form::checkbox('orderid[]', $order->id) }}</th>
						<td>
							@if ($order->status->first()->id == 1)
								<span class="text-danger">{{ $order->status->first()->name }}</span>
							@else 
								{{ $order->status->first()->name }}
							@endif
						</td>
						<td><strong>{{ link_to_route('admin.orders.show', $order->rma_number, $order->id, ['class' => 'rma-link', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => trans('admin.message.order_show')]) }}</strong></td>
						<td>{{ $order->item }}</td>
						<td>{{ $order->client }}</td>
						<td>{{ $order->client_phone }}</td>
						<td>{{ $order->branch->first()->name }}</td>
						<td class="edit">
							<button type="button" class="btn-details btn btn-primary btn-xs" data-toggle="collapse" data-target=".collapsible-details-{{ $order->id }}">
								{{-- trans('admin.message.order_details') --}}
								<span class="glyphicon glyphicon-tasks"></span>
							</button>
							{{-- link_to_route('admin.orders.edit', trans('admin.message.buttons.edit'), $order->id, ['class' => 'btn btn-primary btn-xs']) --}}
							<div class="btn-group btn-group-xs">
								<a href="{{ URL::route('admin.orders.show', $order->id) }}" class="btn-show-order btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
								<a href="{{ URL::route('admin.orders.edit', $order->id) }}" class="btn-edit-order btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" class="btn-delete-order btn btn-primary btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete" data-order-id="{{ $order->id }}"><span class="glyphicon glyphicon-trash"></span></a>
							</div>
							<div class="btn-group btn-group-xs">
								<a href="{{ URL::route('admin.orders.print', $order->id) }}" target="_blank" class="btn-print-order btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span></a>
								<a href="{{ URL::route('admin.orders.printlabel', $order->id) }}" target="_blank" class="btn-print-order btn btn-primary btn-xs"><span class="glyphicon glyphicon-barcode"></span></a>							
							</div>
						</td>
					</tr>
					<tr>
						<td class="rma_details" colspan="9">
	
							<div class="collapse collapsible-details collapsible-details-{{ $order->id }}">
								<div class="details-wrapper">
									<table class="table table-bordered details-table">
										<thead>
											<tr>
												<th width="15%">{{ trans('admin.message.order_serial_number') }}</th>
												<th width="15%">{{ trans('admin.message.order_document') }}</th>
												<th width="15%">{{ trans('admin.message.order_creator') }}</th>
												<th width="15%">{{ trans('admin.message.order_ext_service') }}</th>
												<th width="15%">{{ trans('admin.message.order_price_netto') }}</th>
												<th width="15%">{{ trans('admin.message.order_price_brutto') }}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>@if ($order->serial_number) {{ $order->serial_number }} @else {{ '---' }} @endif</td>
												<td>@if ($order->pa_fv) {{ $order->pa_fv }} @else {{ '---' }} @endif</td>
												<td>{{ $order->user->firstname .' '. $order->user->lastname }}</td>
												<td>@if ($order->ext_service) {{ $order->ext_service }} @else {{ '---' }} @endif</td>
												<td>{{ $order->price_netto }}</td>
												<td>{{ $order->calculateBrutto() }}</td>
											</tr>
										</tbody>
										<thead>
											<tr>
												<th colspan="3">{{ trans('admin.message.order_description') }}</th>
												<th colspan="3">{{ trans('admin.message.order_accessories') }}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="3">{{ $order->description }}</td>
												<td colspan="3">@if ($order->accesories) {{ $order->accesories }} @else {{ '---' }} @endif</td>
											</tr>
										</tbody>
										<thead>
											<tr>
												<th colspan="3">{{ trans('admin.message.order_comments') }}</th>
												<th colspan="3">{{ trans('admin.message.order_diagnose') }}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="3">@if ($order->comments) {{ $order->comments }} @else {{ '---' }} @endif</td>
												<td colspan="3">@if ($order->diagnose) {{ $order->diagnose }} @else {{ '---' }} @endif</td>
											</tr>
										</tbody>
									</table><!-- table .details-table -->
								</div><!-- .details-wrapper -->
							</div><!-- .collapsible-details -->
	
						</td><!-- .rma_details -->
					</tr>
					@endforeach
				</tbody>
			</table>

			<div id="edit-form" class="row">
				<div class="col-md-12">
					<div class="input-row">
						<span class="input-inline bottom">
							{{ Form::label('mass_status', 'Zmień status dla zaznaczonych na:')}}
							{{ Form::select('mass_status', ['' => 'Wybierz nowy status'] + $statuses, null, ['class' => 'form-control input-sm']) }}
						</span>
						<span class="input-inline bottom">
							{{ Form::submit('Zapisz', ['class' => 'btn btn-default btn-sm']) }}
						</span>
					</div>
				</div>
			</div> <!-- #edit-form  -->

			{{ Form::close() }}
		</div>
	</div>
</div> <!-- #orders-table -->

<div id="bottom-pagination" class="row">
	<div class="col-md-12">
		<div class="pagination-wrapper">
			<?php echo $orders->appends(Request::except('page'))->links(); ?>
		</div>
	</div>
</div> <!-- #bottom-pagination -->

<!-- Modal -->
<div id="modal-delete" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::model( $orders, array( 'id' => 'form-delete-confirm', 'method' => 'DELETE', 'route' => array('admin.orders.destroy', 0))) }}
	{{ Form::hidden('order_to_delete', null, ['id' => 'order-to-delete']) }}
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
				{{ Form::button(trans('admin.message.buttons.cancel'), ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) }}
				{{ Form::submit(trans('admin.message.buttons.delete'), ['class' => 'btn btn-primary btn-danger'])}}
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div> <!-- #modal-delete -->
@stop