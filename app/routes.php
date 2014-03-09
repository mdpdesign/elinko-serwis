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

// Event::listen('illuminate.query', function($query) {
// 	var_dump($query);
// });


// Pokaz ekran logowania dla uzytkownika
Route::get('login', array( 'as' => 'login', 'uses' => 'HomeController@getLogin'));

// Zaloguj uzytkownika po wprowadzeniu danych do formularza
Route::post('login', array( 'as' => 'login', 'uses' => 'HomeController@postLogin'));

// Wyloguj uzytkownika z systemu
Route::get('logout', array( 'as' => 'logout', 'uses' => 'HomeController@getLogout'));

// Zalogowany uzytkownik, przenosimy do admina
Route::get('admin', array( 'as' => 'admin', 'before' => 'auth', 'uses' => 'HomeController@getAdmin'));

// Pokaz ekran startowy
Route::get('/', array( 'as' => 'home', 'uses' => 'HomeController@getHome'));

// Routing do edycji uzytkownika
Route::resource('/admin/users', 'UserController');


// Routing dla wykresow
Route::get('/admin/orders/reports', [ 'as' => 'admin.orders.reports', 'before' => 'auth', 'uses' => 'ReportsController@index']);



// Routing do zarzadzania zgloszeniami
Route::resource('/admin/orders', 'OrderController');

// Routing do drukowania zlecenia
Route::get('/admin/orders/print/{id}', [ 'as' => 'admin.orders.print', 'before' => 'auth', 'uses' => 'OrderController@printOrder']);

// Routing do drukowania naklejki zlecenia
Route::get('/admin/orders/printlabel/{id}', [ 'as' => 'admin.orders.printlabel', 'before' => 'auth', 'uses' => 'OrderController@printOrderLabel']);

Route::patch('/admin/orders', ['as' => 'admin.orders.massedit', 'uses' => 'OrderController@massEdit']);

Route::post('pull', function() {
	if ( $_POST['payload'] ) {
  		shell_exec( 'git pull' );
  		Log::info('PULL Event OK :)');
  		return 'Git Pull OK';
	}
	Log::info('PULL Event BAD :(');
	return 'Nie pobrano..';
});

Route::get('test', function() {
	return Redirect::route('test.show', Input::all());
	return View::make('phpinfo');
});