<?php

class UserController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		return View::make('users.index')->withUser($user);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Jesli uzytkownik zalogowany edytuje swoje dane
		if ($id == Auth::user()->id)
		{
			$user = Auth::user()->find($id);
			return View::make('users.edit')->withUser($user);
		}
		// jesli uzytkownik zalogowany probuje edytowac dane kogos innego
		else
		{
			return Redirect::route('admin.users.index')->withErrors( trans('admin.message.cannot_edit_other_user') );
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// zasady walidacji logowania
		$rules = array(
			'firstname' => 'required|alpha|min:3',
			'lastname' => 'required|alpha|min:3',
			'email' => 'required|email',
			'password' => 'required|min:5'
		);

		$validator = Validator::make(Input::all(), $rules);

		// walidacja formularza logowania
		if ($validator->fails()) {
			// 1. walidacja niepoprawna
			// 2. przekierowanie do ponownej edycji z informacja o bledach
			return Redirect::route('admin.users.edit', Auth::user()->id)->withErrors($validator)->withInput();
		} else {
			// 1. walidacja poprawna
			// 2. zaktualizuj dane uzytkownika
			// 3. przekierowanie do strony profilu
			$user = Auth::user();
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::route('admin.users.index', $user->id)->withSuccess( trans('admin.message.user_data_changed_success') );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}