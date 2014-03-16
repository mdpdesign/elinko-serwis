<?php

use Serwis\Repositories\UserRepositoryInterface;

class UserController extends \BaseController {
	
	protected $user;

	public function __construct(UserRepositoryInterface $user)
	{
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users.index');
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
		$current_user = Auth::user();
		
		if ($id == $current_user->id or $current_user->hasRole('Admin'))
		{
			($id == $current_user->id) ? $user = $current_user : $user = $this->user->find($id);
			return View::make('users.show')->withUser($user);
		}
		else
		{
			return Redirect::route('admin.userprofile.show', $current_user->id)->withErrors('Nie możesz oglądać profilu innego Użytkownika!');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$current_user = Auth::user();
		
		// Jesli uzytkownik zalogowany edytuje swoje dane
		if ($id == $current_user->id or $current_user->hasRole('Admin'))
		{
			($id == $current_user->id) ? $user = $current_user : $user = $this->user->find($id);
			return View::make('users.edit')->withUser($user);
		}
		// jesli uzytkownik zalogowany probuje edytowac dane innego profilu
		else
		{
			return Redirect::route('admin.userprofile.show', $current_user->id)->withErrors( trans('admin.message.cannot_edit_other_user') );
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
		
		$user = $this->user->fillUser($id, Input::all());
		
		if ($user->updateUniques())
		{
			// 1. walidacja poprawna
			// 2. przekierowanie do strony profilu
			return Redirect::route('admin.userprofile.show', $id)->withSuccess( trans('admin.message.user_data_changed_success') );
		} 
		else
		{
			// 1. walidacja niepoprawna
			// 2. przekieruj spowrotem z bledami i danymi z formularza
			return Redirect::route('admin.userprofile.edit', $id)->withErrors($user->validationErrors)->withInput();
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