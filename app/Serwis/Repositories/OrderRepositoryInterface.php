<?php namespace Serwis\Repositories;

interface OrderRepositoryInterface {
	public function getAll();

	public function allDates();

	public function orderPerDay();
}

?>