<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Ardent implements UserInterface, RemindableInterface {

	// ACL
	use HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	/**
	 * Pola zabezpieczone przed masowa edycja (Mass Assignment).
	 *
	 * @var array
	 */
	protected $guarded = array('id', 'password');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	/**
	 * Zasady walidacji dla pol Uzytkownika
	 *
	 * @var array
	 */
	public static $rules = array(
		'firstname' => 'required|alpha|min:3',
		'lastname' => 'required|alpha|min:3',
		'email' => 'required|email|unique',
		'password' => 'required|min:5'
	);
	
	/**
	 * Automatically Transform Secure-Text Attributes
	 * @var array 
	 */
	public static $passwordAttributes  = array('password');
	public $autoHashPasswordAttributes = true;

	/**
	 * Relacje z innymi Modelami
	 */
	public function orders()
    {
        return $this->hasMany('Order');
    }

	/**
	 * Pobierz pelna nazwe uzytkowniak
	 * @return mixed
	 */
	public function getFullNameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}