<?php

class BaseModel extends Eloquent {

	public $errors;

	/**
	 * Podlaczenie do zdarzen modeli
	 * @return boolean
	 *
	 * https://tutsplus.com/lesson/validating-with-models-and-event-listeners/
	 * http://laravel.com/docs/eloquent#model-events
	 */
	public static function boot() {
		parent::boot();

		static::saving( function( $model )
		{ 
			return $model->validate();
		});
	}

	/**
	 * Walidacja pol w modelu
	 * @return boolean
	 */
	public function validate() 
	{
		$validation = Validator::make( $this->attributes, static::$rules );

		if ( $validation->passes() ) return true;

		$this->errors = $validation->messages();

		return false;
	}
}
