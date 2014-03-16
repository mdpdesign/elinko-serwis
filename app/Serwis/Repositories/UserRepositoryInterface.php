<?php namespace Serwis\Repositories;

interface UserRepositoryInterface {
	public function getAll();
	
	/**
	 * Zwraca znalezionego uzytkownika lub przerywa
	 */
	public function find($user_id);
	
	/**
	 * Wypelnia odpowiednie pola Uzytkownika
	 */
	public function fillUser($user_id, $input = []);
}

?>