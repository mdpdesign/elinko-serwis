@extends('layouts.print')

@section('content')
<style>
@page {
	margin: 1.4em;
}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<div class="field-wrap label">
				{{ DNS1D::getBarcodeHTML( $order->rma_number, "C128", 1, 25) }}
				<h5 style="font-size: 13px;">{{ $order->rma_number }}</h5>
				<p><strong>Data:</strong> {{ $order->created_at }}</p>
				<p><strong>Klient:</strong> {{ $order->client }}</p>
				<p><strong>Telefon:</strong> {{ $order->client_phone }}</p>
				<p><strong>Urządzenie:</strong></p>
				<p>{{ $order->item }}</p>
				<p><strong>Opis zlecenia:</strong></p>
				<p>{{ $order->description }}</p>
			</div>
		</td>
	</tr>
</table>
@stop