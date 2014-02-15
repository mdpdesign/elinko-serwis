<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	// OGOLNE KONTROLERY
	// ///////////////////////////////////////////////
	public function getHome() {
		return View::make('login');
	}

	public function getLogin() {
		return View::make('login');
	}

	public function getLogout() {
		if (Auth::guest()) {
			return Redirect::to('login')->withMessage( trans('signin.message.no_logout_needed') );
		} else {
			Auth::logout();
			return Redirect::to('login')->withMessage( trans('signin.message.user_logged_out') );
		}
	}

	public function postLogin() {

		// zasady walidacji logowania
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:5'
		);

		// Dane uzytkownika
		$userinfo = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);

		$validator = Validator::make(Input::all(), $rules);

		// walidacja formularza logowania
		if ($validator->fails()) {

			// 1. walidacja niepoprawna
			// 2. przekierowanie do logowania z informacja o bledach
			return Redirect::to('login')->withErrors($validator)->withInput();

		} else {

			// 1. walidacja poprawna
			// 2. sprawdzanie poprawnosci zalogowania
			if ( Auth::attempt($userinfo) ) {
				// 1. zalogowany poprawnie
				// 2. pokaz admin
				return Redirect::route('admin.orders.index')->withUser(Auth::user())->withSuccess( trans('signin.message.user_logged') );
			} else {
				// 1. autentykacja niepoprawna
				// 2. przekierowanie do logowania z informacja o bledach
				return Redirect::to('login')->withErrors( trans('signin.message.bad_email_or_password') )->withInput();
			};
		};

		return 'Cos nie tak... Skontaktuj sie z Administratorem: marek@mdpdesign.pl';
	}

	// ADMINISTRACJA - KONTROLERY
	// ///////////////////////////////////////////////
	public function getAdmin() {
		return Redirect::route('admin.orders.index')->withUser(Auth::user());
	}

}