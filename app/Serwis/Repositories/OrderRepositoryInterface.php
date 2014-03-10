<?php namespace Serwis\Repositories;

interface OrderRepositoryInterface {
	public function getAll();

	public function allDates();

	public function orderPerDay();
	
	public function orderPerBranch();
	
	public function orderPerStatus();
}

?>