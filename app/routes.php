<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Event::listen('illuminate.query', function($query, $params, $time) {
//	var_dump(['Query' => $query, 'Params' => $params, 'Time' => $time]);
//});

// Pokaz ekran startowy
Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@getHome' ]);

// Pokaz ekran logowania dla uzytkownika
Route::get('login', [ 'as' => 'login', 'uses' => 'HomeController@getLogin' ]);

// Zaloguj uzytkownika po wprowadzeniu danych do formularza
Route::post('login', [ 'as' => 'login', 'uses' => 'HomeController@postLogin' ]);

// Wyloguj uzytkownika z systemu
Route::get('logout', [ 'as' => 'logout', 'uses' => 'HomeController@getLogout' ]);


Route::group(['before' => 'auth'], function()
{
	// Routing dla panelu Ustawienia
	Route::get('/admin/settings', [ 'as' => 'admin.settings.index', 'uses' => 'HomeController@getSettings' ]);
	
    // Zalogowany uzytkownik, przenosimy do admina
	Route::get('admin', [ 'as' => 'admin', 'uses' => 'HomeController@getAdmin' ]);

	Route::resource('/admin/userprofile', 'UserController', [ 'only' => array('show', 'edit', 'update') ]);

	// Routing do edycji uzytkownika
	Route::resource('/admin/settings/users', 'UserController');

	// Routing dla wykresow
	Route::get('/admin/orders/reports', [ 'as' => 'admin.orders.reports', 'uses' => 'ReportsController@index' ]);

	// Routing do zarzadzania zgloszeniami
	Route::resource('/admin/orders', 'OrderController');

	// Routing dla masowej edycji zlecen
	Route::patch('/admin/orders', [ 'as' => 'admin.orders.massedit', 'uses' => 'OrderController@massEdit' ]);

	// Routing do drukowania zlecenia
	Route::get('/admin/orders/print/{id}', [ 'as' => 'admin.orders.print', 'uses' => 'OrderController@printOrder' ]);

	// Routing do drukowania naklejki zlecenia
	Route::get('/admin/orders/printlabel/{id}', [ 'as' => 'admin.orders.printlabel', 'uses' => 'OrderController@printOrderLabel' ]);
});


// Routing dla wywolania Githuba - automatyczna aktualizacja po akcji push
Route::post('pull', function() {
	if ( $_POST['payload'] ) {
  		shell_exec( 'git pull' );
  		Log::info('PULL Event OK :)');
  		return 'Git Pull OK';
	}
	Log::info('PULL Event BAD :(');
	return 'Nie pobrano..';
});

// phpinfo - tylko do momentu dev
Route::get('test', function() {
	return View::make('phpinfo');
});