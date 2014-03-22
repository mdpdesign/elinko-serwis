<?php

use Serwis\Repositories\OrderRepositoryInterface;

class ReportsController extends BaseController {

	protected $orders;

	public function __construct(OrderRepositoryInterface $order)
	{
		$this->order = $order;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$branch_values = $this->order->orderPerBranch();
		$status_values = $this->order->orderPerStatus();
		
		// pokaz wykres ze zleceniami w zaleznosci od daty
		// ile zlecen w danym dniu, os Y - ilosc zlecen, os X - daty od pierwszego do ostatniego zlecenia z zakresu
		$values = $this->order->orderPerDay();

		return View::make('reports.index')
			->withDates($values->lists('date'))
			->withValues($values->lists('count'))
			->withData($values)
			->withStatusData($status_values)
			->withBranchData($branch_values);
	}
	
	public function perStatus() {
		return $values = $this->order->orderPerStatus();
	}

}
