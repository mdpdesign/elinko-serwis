@extends('layouts.print')

@section('content')
<div class="row">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="50%">
				<img src="{{ asset('images/elinko-logo.png') }}" style="width: 300px; height: auto;" alt="Elinko Logo">
			</td>
			<td width="50%">
				<h6>Potwierdzenie dostarczenia sprzętu do serwisu nr:</h6>
				{{ DNS1D::getBarcodeHTML( $order->rma_number, "C128", 1, 25) }}
				<h4>{{ $order->rma_number }}</h4>
				<h5>{{ $order->history->last()->created_at }} <strong>Oddział:</strong> {{ $order->branch->first()->name }}</h5>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="field-wrap border">
					<p>
						<strong>ELINKO – komputery, kasy fiskalne, oprogramowanie, strony internetowe, serwis, sprzedaż.</strong><br>
						43-150 Bieruń, ul. Bojszowska 2, 43-143 Lędziny, ul. Fredry 6p<br>
						NIP: 646-17-72-620, Bieruń - tel: 32-219-09-75, Lędziny - tel: 32-216-14-32<br>
						www.elinko.com.pl, e-mail: biuro@elinko.com.pl
					</p>
				</div>
			</td>
		</tr>
	</table>

</div>

<div class="row">
	<div style="margin-top: 10px;">&nbsp;</div>
	<table width="100%" cellpadding="0" cellspacicn="0" border="0" style="border-collapse: collapse">
		<tr>
			<th width="50%"></th>
			<th width="50%"></th>
		</tr>
		<tr>
			<td>
				<div class="field-wrap border">
					<h5><strong>Dane Klienta:</strong></h5>
					<p>{{ $order->client }}</p>
				</div>
			</td>
			<td>
				<div class="field-wrap border">
					<h5><strong>Telefon kontaktowy:</strong></h5>
					<p>{{ $order->client_phone }}</p>
				</div>
			</td>

		</tr>
		<tr>
			<td colspan="2">
				<div class="field-wrap border">
					<h5><strong>Sprzęt oddany do serwisu:</strong></h5>
					<p>{{ $order->item }} @if ($order->serial_number) <strong>Numer seryjny:</strong> {{ $order->serial_number }} @endif</p>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="field-wrap border">
					<h5><strong>Opis zlecenia:</strong></h5>
					<p>{{ $order->description }}</p>
					<p>@if ($order->accesories) <strong>Dołączone akcesoria:</strong> {{ $order->accesories }} @endif</p>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<ul class="conditions">
					<li>Firma P.H.U. Elinko S. C. nie ponosi odpowiedzialności za zainstalowane oprogramowanie, w szczególności gdy jest nielegalne.</li>
					<li>Oddany do serwisu towar w celu reklamacji / naprawy, powinien być odebrany przez klienta w terminie do 30 dni od daty zakończenia naprawy /
					wymiany uszkodzonego podzespołu. Po upływie tego terminu towar ulega zniszczeniu lub staje się własnością P.H.U. Elinko S.C. w celu pokrycia
					kosztów jego magazynowania.</li>
					<li>Czas naprawy uwarunkowany jest dostępnością odpowiednich części zamiennych, jak też stopniem skomplikowania usterki i wynosi maksymalnie 60 dni roboczych od momentu przyjęcia sprzętu do serwisu.</li>
					<li>Klient jest odpowiedzialny za archiwizację ważnych danych przed przekazaniem sprzętu do serwisu. Firma P.H.U. Elinko S. C. nie ponosi odpowiedzialności, za utratę danych.</li>
					<li>Jeżeli sprzęt okaże się w pełni sprawny, osoba zlecająca naprawę może zostać obciążona opłatą za ekspertyzę techniczną.</li>
					<li>Diagnoza i ustalenie usterki to koszt 20 zł brutto, jeśli naprawa nie będzie dalej wykonywana.</li>
					<li>Potwierdzenie dostarczenia sprzętu do serwisu, jest jedynym dokumentem upoważniającym do odbioru sprzętu, pracownik serwisu może odmówić wydania towaru bez okazania potwierdzenia.</li>
					<li>Podpisując niniejsze zlecenie klient oświadcza, że zapoznał się ze wszystkimi informacjami przed oddaniem sprzętu do serwisu.</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td><div class="field-wrap border">
				<p>Podpis Klienta:</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>.....................................................................</p>
			</div></td>
			<td><div class="field-wrap border">
				<p>Potwierdzenie odbioru sprzętu przez Klienta</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>.....................................................................</p>
			</div></td>
		</tr>
	</table>
</div>

<div class="row">
	<table width="100%">
		<tr>
			<td>
				<div class="field-wrap" style="text-align: center;">
					<p style="font-size:10px;">Tutaj przetnij ..........................................................................................................................................................................................</p>
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="row">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="50%">
				<div class="field-wrap border">
					{{ DNS1D::getBarcodeHTML( $order->rma_number, "C128", 1, 20) }}
					<h4>{{ $order->rma_number }}</h4>
					<p><strong>Klient:</strong> {{ $order->client }}, <strong>telefon:</strong> {{ $order->client_phone }}</p>
				</div>
			</td>
			<td width="50%">
				<div class="field-wrap border">
					{{ DNS1D::getBarcodeHTML( $order->rma_number, "C128", 1, 20) }}
					<h4>{{ $order->rma_number }}</h4>
					<p><strong>Klient:</strong> {{ $order->client }}, <strong>telefon:</strong> {{ $order->client_phone }}</p>
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="row">
	<table width="100%">
		<tr>
			<td>
				<div class="field-wrap" style="text-align: center;">
					<p style="font-size:10px;">Tutaj przetnij ..........................................................................................................................................................................................</p>
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="row">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="50%">
				<img src="{{ asset('images/elinko-logo.png') }}" style="width: 300px; height: auto;" alt="Elinko Logo">
			</td>
			<td width="50%">
				<h6>Potwierdzenie dostarczenia sprzętu do serwisu nr:</h6>
				{{ DNS1D::getBarcodeHTML( $order->rma_number, "C128", 1, 25) }}
				<h4>{{ $order->rma_number }}</h4>
				<h5>{{ $order->history->last()->created_at }}</h5>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="field-wrap border">
					<p>
						<small>
							<strong>ELINKO – komputery, kasy fiskalne, oprogramowanie, strony internetowe, serwis, sprzedaż.</strong><br>
							43-150 Bieruń, ul. Bojszowska 2, 43-143 Lędziny, ul. Fredry 6p<br>
							NIP: 646-17-72-620, Bieruń - tel: 32-219-09-75, Lędziny - tel: 32-216-14-32<br>
							www.elinko.com.pl, e-mail: biuro@elinko.com.pl
						</small>
					</p>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="field-wrap border">
					<p><strong>Klient:</strong> {{ $order->client }}, <strong>telefon:</strong> {{ $order->client_phone }}</p>
					<p><strong>Sprzęt:</strong> {{ $order->item }} @if ($order->serial_number) <strong>Numer seryjny:</strong> {{ $order->serial_number }} @endif</p>
				</div>
			</td>
		</tr>
		<tr>
			<td><div class="field-wrap border">
				<p class="small">Podpis Klienta:</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>.....................................................................</p>
			</div></td>
			<td><div class="field-wrap border">
				<p class="small">Podpis Serwisanta / osoby przyjmującej zlecenie</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>.....................................................................</p>
			</div></td>
		</tr>
	</table>

</div>

@stop