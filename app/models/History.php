<?php

class History extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'history';

	/**
	 * Relacja z innymi modelami
	 * @return relation
	 */
	public function historable()
    {
        return $this->morphTo();
    }
}
