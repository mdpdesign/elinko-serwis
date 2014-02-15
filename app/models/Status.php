<?php

class Status extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Relacje z innymi Modelami
	 * Status __
	 */
	
	// Statuses __belongs_to_many__ Orders
	public function status()
    {
        return $this->belongsToMany('Order');
    }
}
