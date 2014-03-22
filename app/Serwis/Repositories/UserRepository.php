<?php namespace Serwis\Repositories;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\Process\Exception\RuntimeException;
use User;

 class UserRepository implements UserRepositoryInterface {
	 
	 protected $model;
			 
	 function __construct(User $model) {
		 $this->model = $model;
	 }
	 
	 /**
	  * Tworzy instancje nowego uzytkownika wypelniajac wlasciwosci
	  * @param array $input
	  * @return \User
	  */
	 public function newUser($input) {
		 $new_user = new User($input);
		 $new_user->password = $input['password'];
		 return $new_user;
	 }
	 
	 /**
	  * Zwraca cala kolekcje uzytkownikow
	  * @return Collection User
	  */
	 public function getAll() {
		 return $this->model->with('roles')->get();
	 }
	 
	 /**
	  * Zwraca znalezionego uzytkownika
	  * @param type $user_id
	  * @return Collection User
	  */
	 public function find($user_id) {
		 return $this->model->with('roles')->findOrFail($user_id);
	 }
	 
	 /**
	  * Wpisuje odpowiednie dane do Uzytkownika
	  * 
	  * @param int $user_id
	  * @param array $input
	  * @return Eloquent Model
	  * @throws Exception
	  */
	 public function fillUser($user_id, $input = []) {
		 
		 if (empty($input))
		 {
			 throw new RuntimeException;
		 }
		 else
		 {	
			$user = $this->model->findOrFail($user_id);
			
			// wypelnij wszystkie pola oprocz guarded
			$user->fill($input);
			
			// bez hashowania Ardent hash'uje przed zapisem 
			$user->password = $input['password'];
			
			return $user;
		 }
	 }

}

