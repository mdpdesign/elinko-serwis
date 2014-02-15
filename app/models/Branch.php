<?php

class Branch extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Relacje z innymi Modelami
	 */
	
	// Branch __belongs_to_many__ Orders
	public function order()
	{
		return $this->belongsToMany('Order');
	}

	public function getBranches()
	{
		return $this->all();
	}

	/**
	 * Zwraca tablice par klucz - nazwa
	 * @return array
	 */
	public function getArrayToSelect()
	{
		$toSelect = array();
		$branches = $this->all();
		foreach ($branches as $branch) {
			$toSelect[$branch->id] = $branch->name;
		}
		return $toSelect;
	}
}
