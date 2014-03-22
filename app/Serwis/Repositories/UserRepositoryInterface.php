<?php namespace Serwis\Repositories;

interface UserRepositoryInterface {
	
	/**
	 * Tworzy instancje nowego uzytkownika
	 */
	public function newUser($input);
	
	/**
	 * Zwraca kolekcje wszystkich uzytkownikow
	 */
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