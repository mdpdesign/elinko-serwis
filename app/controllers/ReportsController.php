<?php

use Serwis\Repositories\OrderRepositoryInterface;

class ReportsController extends BaseController {

	protected $user;
	protected $orders;

	public function __construct(OrderRepositoryInterface $order)
	{
		$this->user = Auth::user();
		$this->order = $order;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// pokaz wykres ze zleceniami w zaleznosci od daty
		// ile zlecen w danym dniu, os Y - ilosc zlecen, os X - daty od pierwszego do ostatniego zlecenia z zakresu
		$values = $this->order->orderPerDay();

		return View::make('reports.index')->withUser($this->user)
			->withDates($values->lists('date'))
			->withValues($values->lists('count'));
	}

}
