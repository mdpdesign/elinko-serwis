<?php namespace Serwis\Helpers;

use Illuminate\Support\Facades\Auth;

class SerwisHelper {
	
	/**
	 * Zwraca ID aktulalnie zalogowanego Uzytkownika
	 * 
	 * @return int
	 */
	public function authUserId() {
		return Auth::user()->id;
	}
	
	/**
	 * Zwraca Imie i Nazwisko aktualnie zalogowanego Uzytkownika
	 * 
	 * @return string
	 */
	public function authUserFullName() {
		return Auth::user()->firstname . ' ' . Auth::user()->lastname;
	}
	
	/**
	 * Zwraca adres email aktualnie zalogowanego Uzytkownika
	 * 
	 * @return string
	 */
	public function authUserEmail() {
		return Auth::user()->email;
	}
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

