<?php

class OrderController extends BaseController {
	
	protected $orders;

	public function __construct(Order $order) {
		$this->beforeFilter('auth');
		$this->orders = $order;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$user = Auth::user();
		
		// jesli kolekcja jest pusta pokaz informacje ze nie ma co pokazac
		if ($this->orders->all()->isEmpty())
		{
			return View::make('orders.empty')->withUser($user);
		}
		// jesli kolekcja NIE jest pusta pokaz liste zlecen
		else
		{

			// listy statusow i oddzialow
			$branch = Branch::orderBy('id')->lists('name', 'id');
			$status = Status::orderBy('id')->lists('name', 'id');

			// jelsi istnieje zmienna search, wtedy wyszukujemy, pokaz tylko 
			// kolekce spelniajaca kryteria wyszukiwania
			if (Input::get('search'))
			{
				$term = Input::get('search');
				$orders = $this->orders->getSearchQuery($term, Input::get('order', 'DESC'), Input::get('status'), Input::get('branch'))->paginate(Input::get('perpage', 20));
				
				// jesli kolekcja nie spelnia kryteriow wyszukiwania pokaz informacje
				if ($orders->isEmpty())
				{
					// pokaz informacje ze nie ma wynikow wyszukiwania dla podanych kryteriow
					return View::make('orders.empty')->withUser($user)->withErrors('Nie odnaleziono zleceń spełniających kryterium wyszukiwania');
				}
				// pokaz wyniki wyszukiwania
				return View::make('orders.index')->withUser($user)->withOrders($orders)
					->withStatuses($status)
					->withBranches($branch)
					->withSearch($term);
			}
			// jesli nie wyszukujemy
			else
			{

				// jesli filtrujemy wyniki
				if (Input::has('status') or Input::has('branch') or Input::has('order'))
				{
					$orders = $this->orders->getFilteredResults(Input::get('status'), Input::get('branch'), Input::get('order', 'ASC'))->with('user')->paginate(Input::get('perpage', 20));

					return View::make('orders.index')->withUser($user)
					->withOrders($orders)
					->withStatuses($status)
					->withBranches($branch)
					->withInput(Input::only('status', 'branch', 'order', 'perpage'));
				}
				// nie wyszukujemy, nie filtrujemy, pokaz wszystkie zlecenia
				$orders = $this->orders->with('status')->with('branch')->with('user')->orderBy('status_id', 'ASC')->orderBy('id', 'DESC')->paginate(Input::get('perpage', 20));

				return View::make('orders.index')->withUser($user)
				->withOrders($orders)
				->withStatuses($status)
				->withBranches($branch)
				->withInput(Input::old());
			}
		}
		
		return false;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$branch = Branch::orderBy('id')->lists('name', 'id');
		$status = Status::orderBy('id')->lists('name', 'id');
		
		$usersList = User::all()->lists('full_name', 'id');
		asort($usersList);

		return View::make('orders.create')
		->withUser(Auth::user())
		->withUsersList($usersList)
		->withStatuses($status)
		->withBranches($branch);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		
		$user = Auth::user();
		$order = new Order(Input::all());
		$order->rma_number = $order->generateRMA();

		$order->setRawAttributes($order->prepareForInsert(Input::only(['item', 'client', 'pa_fv', 'ext_service'])));

		if ($order->save()) {
			$order->status()->attach(Input::get('status_id'));
			$order->branch()->attach(Input::get('branch_id'));
			$order->history()->create(['event' => trans('admin.message.order_created_by') . User::find(Input::get('user_id'))->full_name ]);

			return Redirect::route('admin.orders.index')->withSuccess(trans('admin.message.order_added'));
		}

		return Redirect::route('admin.orders.create')->withInput($order->attributes)->withErrors($order->errors);
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$order = Order::with('status')->with('branch')->with('history')->find($id);

		$user = Auth::user();
		$usersList = User::all()->lists('full_name', 'id');

		$branch = Branch::orderBy('id')->lists('name', 'id');
		$status = Status::orderBy('id')->lists('name', 'id');

		return View::make('orders.show')
		->withOrder($order)
		->withUser($user)
		->withUsersList($usersList)
		->withStatuses($status)
		->withBranches($branch);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		
		$order = $this->orders->with('status')->with('branch')->with('user')->with('history')->findOrFail($id);
		$user = Auth::user();

		$branch = Branch::orderBy('id')->lists('name', 'id');
		$status = Status::orderBy('id')->lists('name', 'id');

		return View::make('orders.edit')->withOrder($order)->withUser($user)->withStatuses($status)->withBranches($branch);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		
		$user = Auth::user();
		$order = $this->orders->findOrFail($id);
		$order->fill(Input::all());
		$order->setRawAttributes($order->prepareForInsert(Input::only(['item', 'client', 'pa_fv', 'ext_service'])));

		//jesli poprawnie zapisano zlecenie do bazy
		if ($order->save()) {
			$order->status()->sync([Input::get('status_id')]);
			$order->history()->create(['event' => trans('admin.message.order_modified_by') . $user->full_name]);
			return Redirect::route('admin.orders.show', $id)->withSuccess(trans('admin.message.order_updated'));
		}
		// jesli nie zapisano powroc do edycji z informacjami o bledach
		return Redirect::route('admin.orders.edit', $id)->withInput($order->attributes)->withErrors($order->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// pobierz kolekcje z bazy
		$order = Order::findOrFail($id);

		// jesli jistnieje kolekcja
		if ($order)
		{
			$order->status()->detach();
			$order->branch()->detach();
			$order->history()->delete();
			$order->delete();
			
			return Redirect::route('admin.orders.index')->withSuccess( trans('admin.message.order_delete_success') );
		}
		else
		{
			return 'Nie można odnależć modelu!!!';
		}
		
		return Redirect::route('admin.order.index')->withErrors( trans('admin.message.contact_administrator') );
	}


	/**
	 * Wyswietla strone ze zleceniem do wydruku.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function printOrder($id) {
		$order = $this->orders->with('status')->with('branch')->with('history')->find($id);

		$user = Auth::user();
		$usersList = User::all()->lists('full_name', 'id');

		$branch = Branch::orderBy('id')->lists('name', 'id');
		$status = Status::orderBy('id')->lists('name', 'id');

		$pdf = PDF::loadView('orders.printorder', ['order' => $order]);
		return $pdf->stream($order->rma_number);

		//return View::make('orders.printorder')
		//->withOrder($order);
	}


	/**
	 * Wyswietla strone ze zleceniem do wydruku naklejki.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function printOrderLabel($id) {
		$order = $this->orders->with('status')->with('branch')->with('history')->find($id);

		$user = Auth::user();

		$usersList = User::all()->lists('full_name', 'id');
		$branch = Branch::orderBy('id')->lists('name', 'id');
		$status = Status::orderBy('id')->lists('name', 'id');

		// setPaper
		// https://github.com/dompdf/dompdf/blob/master/include/cpdf_adapter.cls.php
		// http://www.unitconversion.org/typography/centimeters-to-points-computer-conversion.html
		// etykietka 60mm x 50mm
		$pdf = PDF::loadView('orders.printorderlabel', ['order' => $order])->setPaper(array(0,0, 141.73, 141.73 ));
		return $pdf->stream('label_' . $order->rma_number);

	}


	public function massEdit()
	{
		if (Input::has('mass_status'))
		{
			if (Input::has('orderid'))
			{
				$newStatus = Input::get('mass_status');
				
				foreach (Input::get('orderid') as $order)
				{
					$currentOrder = $this->orders->findOrFail($order);
					$currentOrder->status_id = $newStatus;
					$currentOrder->save();
					$currentOrder->status()->sync([$newStatus]);
				}

				return Redirect::back()->withSuccess('Zaktualizowano poprawnie!');
			}
			else 
			{
				return Redirect::back()->withInput()->withErrors('Nie zaznaczono zleceń do zmiany!');
			}
		}
		else 
		{
			return Redirect::back()->withInput()->withErrors('Należy wybrać nowy status!');
		}
	}

}
