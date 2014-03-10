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

			// listy statusow, oddzialow, uzytkownikow
			$branch = Branch::orderBy('id')->lists('name', 'id');
			$status = Status::orderBy('id')->lists('name', 'id');
			$usersList = User::all()->lists('full_name', 'id');
			asort($usersList);

			// jesli istnieje zmienna search, wtedy wyszukujemy, pokaz tylko 
			// kolekce spelniajaca kryteria wyszukiwania
			if (Input::get('search'))
			{
				$term = Input::get('search');
				$orders = $this->orders->getSearchQuery($term, Input::get('order', 'ASC'), Input::get('status'), Input::get('branch'))->paginate(Input::get('perpage', 20));
				
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
					->withUsers($usersList)
					->withSearch($term);
			}
			// jesli nie wyszukujemy
			else
			{

				// jesli filtrujemy wyniki
				if (Input::has('status') or Input::has('branch') or Input::has('owner') or Input::has('order'))
				{
					$orders = $this->orders->getFilteredResults(Input::get('status'), Input::get('branch', null), Input::get('owner', null), Input::get('order', 'ASC'))->with('user')->paginate(Input::get('perpage', 20));
					
					// zapamietujemy filtrowanie do nastepnego request'u
					Input::flashOnly('status', 'branch', 'order', 'perpage');

					// jesli po filtrowaniu kolekcja jest pusta pokaz informacje
					if ($orders->isEmpty())
					{
						return View::make('orders.index')->withUser($user)
						->withUsers($usersList)
						->withOrders($orders)
						->withStatuses($status)
						->withBranches($branch)
						->withErrors('Zlecenia nie spełniają kryteriów filtrowania. Popraw filtry.');
					}
					
					// pokaz wyniki filtrowania
					return View::make('orders.index')->withUser($user)
					->withUsers($usersList)
					->withOrders($orders)
					->withStatuses($status)
					->withBranches($branch);
				}
				// nie wyszukujemy, nie filtrujemy, pokaz wszystkie zlecenia
				$orders = $this->orders->with('status')->with('branch')->with('user')->orderBy('status_id', 'ASC')->orderBy('id', 'DESC')->paginate(Input::get('perpage', 20));
				
				// pokaz cala liste, resetowanie ew. sortowania itp
				Input::flush();
				
				return View::make('orders.index')->withUser($user)
				->withUsers($usersList)
				->withOrders($orders)
				->withStatuses($status)
				->withBranches($branch);
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

			return Redirect::route('admin.orders.show', $order->id)->withSuccess(trans('admin.message.order_added'));
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
		
		$before = $order->attributesToArray();
		$order->fill(Input::all());
		$order->setRawAttributes($order->prepareForInsert(Input::only(['item', 'client', 'pa_fv', 'ext_service'])));
		$after = $order->attributesToArray();

		//jesli poprawnie zapisano zlecenie do bazy
		if ($order->save()) {
			$order->status()->sync([Input::get('status_id')]);		
			$order->history()->create(['event' => trans('admin.message.order_modified_by') . $user->full_name . ' zmiana: ' . $order->getModifiedAttributes($before, $after)]);
			
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
		$order = $this->orders->findOrFail($id);

		// jesli jistnieje kolekcja, usun wszystkie powiazania i samo Zlecenie
		if ($order)
		{
			$order->status()->detach();
			$order->branch()->detach();
			$order->history()->delete();
			$order->delete();
			
			return Redirect::route('admin.orders.index')->withSuccess( trans('admin.message.order_delete_success') );
		}
		// nie odnaleziono Zlecenia do usuniacia, blad aplikacji, skontaktuj sie z Administratorem
		else
		{
			return Redirect::route('admin.order.index')->withErrors( trans('admin.message.contact_administrator') );
		}
		// Jesli cos ogolnie poszlo nie tak
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

		// return View::make('orders.printorder')
		// ->withOrder($order);
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
		$pdf = PDF::loadView('orders.printorderlabel', ['order' => $order])->setPaper(array(0, 0, 141.73, 170.07 ));
		return $pdf->stream('label_' . $order->rma_number);

	}


	/**
	 * Masowa aktualizacja stattusow zamowien, dodaje wpis do historii Zlecenia
	 * 
	 * @return Response
	 */
	public function massEdit()
	{
		// jezeli wybrano z pola select nowy status
		if (Input::has('mass_status'))
		{
			// jesli wybrano Zlecenia do zmiany
			if (Input::has('orderid'))
			{
				$user = Auth::user();
				$statuses = Status::all();
				$orders = $this->orders->with('status')->findMany(Input::get('orderid'));
				$newStatus = Input::get('mass_status');
				
				// dla kazdego zlecenia: dodaj historie, zaktualizuj status
				foreach ($orders as $order)
				{
					$order->history()->create(['event' => 'Masowa edycja przez: ' . $user->full_name . ' poprzedni status: ' . $order->status->first()->name . ' nowy status: ' . $statuses->find($newStatus)->name ]);
					$order->status_id = $newStatus;
					$order->save();
					$order->status()->sync([$newStatus]);
				}
				// poprawnie zaktualizowano wszystkie zaznaczone Zlecenia
				return Redirect::back()->withSuccess('Zaktualizowano poprawnie!');				
			}
			// nie zaznaczono zadnych Zlecen do zmiany
			else
			{
				return Redirect::back()->withInput()->withErrors('Nie zaznaczono zleceń do zmiany!');
			}
		}
		// nie wybrano statusu z pola select
		else 
		{
			return Redirect::back()->withInput()->withErrors('Należy wybrać nowy status!');
		}
	}

}
