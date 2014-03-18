<?php

use Serwis\Repositories\UserRepositoryInterface;
use Role;

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
		$roles = Role::orderBy('id')->lists('name', 'id');
		return View::make('users.create')->withRole($roles);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$new_user = $this->user->newUser(Input::only(['firstname', 'lastname', 'email', 'password']));
		
		if ($new_user->save())
		{
			$new_user->attachRole( Input::get('role') );
			return Redirect::route('admin.settings.users.show', $new_user->id)->withSuccess( trans('Uzytkownikzapisany poprawnie :)') );
		}
		else
		{
			return Redirect::back()->withErrors($new_user->validationErrors)->withInput();
		}
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
		
		if ($id == $current_user->id or $current_user->can('manage_users'))
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
		$roles = Role::orderBy('id')->lists('name', 'id');
		$current_user = Auth::user();
		
		// jesli aktualny uzytkownik (administrator) moze edytowac innych
		if ( $current_user->can('manage_users') )
		{
			// jesli administrator edytuje swoj profil
			if ( $id == $current_user->id )
			{
				// pokaz formularz edycji administratora bez edycji rol
				return View::make('users.edit')->withUser($current_user);
			}
			// jesli administrator edytuje inny profil, nawet innego administratora
			else
			{
				// pokaz formularz edycji z edycja rol
				$user = $this->user->find($id);
				return View::make('users.edit')->withCanEditRoles(true)->withRoles($roles)->withUser($user);
			}
		}
		// jesli aktualny uzytkownik nie jest administratorem
		else 
		{
			// jesli aktualny uzytkownik edytuje swoj profil
			if ( $id == $current_user->id )
			{
				// pokaz vidok edycji bez edycji rol
				return View::make('users.edit')->withUser($current_user);
			}
			// jesli uzytkownik probuje dycji innego profilu
			else
			{
				// przekieruj do widoku swojego profili z bledami ze nie moze edytowac innego profilu!
				return Redirect::route('admin.userprofile.show', $current_user->id)->withErrors( trans('admin.message.cannot_edit_other_user') );
			}
				
		}
		
		
//		// Jesli uzytkownik zalogowany edytuje swoje dane
//		if ($id == $current_user->id)
//		{
//			if ($current_user->can('manage_users') and !$current_user->hasRole('Administrator'))
//			{
//				($id == $current_user->id) ? $user = $current_user : $user = $this->user->find($id);
//				return View::make('users.edit')->withUser($user);
//			}
//			// edytuj aktualnego uzytkownika, bez mozliwosci przypisania roli
//			return View::make('users.edit')->withUser($user);
//		}
//		// jesli uzytkownik zalogowany probuje edytowac dane innego profilu
//		else
//		{
//			return Redirect::route('admin.userprofile.show', $current_user->id)->withErrors( trans('admin.message.cannot_edit_other_user') );
//		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$current_user = Auth::user();
		$user = $this->user->fillUser($id, Input::only('firstname', 'lastname', 'email', 'password'));
		
		if ($user->updateUniques())
		{
			// 1. walidacja poprawna
			// 2. przekierowanie do strony profilu
			if ($current_user->can('manage_users')) 
			{
				$user->roles()->sync( [Input::get('role')] );
				return Redirect::route('admin.settings.users.show', $id)->withSuccess( trans('admin.message.user_data_changed_success') );
			}
			return Redirect::route('admin.userprofile.show', $id)->withSuccess( trans('admin.message.user_data_changed_success') );
		} 
		else
		{
			// 1. walidacja niepoprawna
			// 2. przekieruj spowrotem z bledami i danymi z formularza
			if ($current_user->can('manage_users')) 
			{
				return Redirect::route('admin.settings.users.edit', $id)->withErrors($user->validationErrors)->withInput();
			}
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