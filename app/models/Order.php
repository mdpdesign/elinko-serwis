<?php

use LaravelBook\Ardent\Ardent;

class Order extends Ardent {
	
	/**
	 * Pola zabezpieczone przed masowa edycja (Mass Assignment)
	 *
	 * @var array
	 */
	protected $guarded = array('id');

	public static $rules = array(
		'status_id'     => 'required',
		'user_id'       => 'integer',
		'item'          => 'required',
		'serial_number' => '',
		'pa_fv'         => '',
		'client'        => 'required',
		'client_phone'  => ['regex:#([\d]{3}-[\d]{3}-[\d]{3}|[\d]{2}-[\d]{3}-[\d]{2}-[\d]{2})#'],
		'price_netto'   => 'numeric|between:0,99999',
		'description'   => 'required',
		'comments'      => '',
		'accesories'    => '',
		'branch_id'     => 'required'
	);

	protected static $named_fields = array(
		'status_id'     => 'Status',
		'user_id'       => 'ID Użytkownika',
		'item'          => 'Sprzęt',
		'serial_number' => 'Numer seryjny',
		'pa_fv'         => 'Dokument',
		'client'        => 'Klient',
		'client_phone'  => 'Telefon',
		'ext_service'   => 'Serwis zew.',
		'price_netto'   => 'Cena netto',
		'diagnose'      => 'Diagnoza',
		'description'   => 'Opis',
		'comments'      => 'Uwagi',
		'accesories'    => 'Akcesoria',
		'branch_id'     => 'Oddział'
	);

	/**
	* Event deleted, wykonuje czynnosci kiedy Order jest usuniety
	* @param  string $value
	* @return void
	*/
	public static function boot()
	{
		parent::boot();

		// Setup event bindings...
		Order::deleted( function($order)
		{
			DB::table('history')->where('historable_id', '=', $order->id)->where('historable_type', '=', 'Order')->delete();
		});
	}

	/**
	* Zwraca odpowiedni format daty i czasu
	* @return DateTime
	*/
	public function get_short_updated_at()
	{
		$date = $this->updated_at;
		if ($date) return $date->format('H:i:s d-m-Y');
	}

	/**
	* Zwraca krotszy opis zleceniea (do wydruku etykiety serwisowej)
	* @return DateTime
	*/
	public function get_short_description()
	{
		return ( strlen($this->description) > 90 ) ? substr($this->description, 0, strrpos(substr($this->description, 0, 90), ' ')) . ' (...)' : $this->description;
	}


	/**
	 * Getter dla pola cena_netto, zamienia kropke na przecinek
	 * @param  string $value
	 * @return string
	 */
	public function getPriceNettoAttribute($value)
	{
		return str_replace('.', ',', $value);
	}

	/**
	 * Setter dla pola cena_netto, zamienia przecinek na kropke
	 * @param  string $value
	 * @return string
	 */
	public function setPriceNettoAttribute($value)
	{
		$this->attributes['price_netto'] =  str_replace(',', '.', $value);
	}

	public function calculateBrutto()
	{
		return str_replace('.', ',', money_format("%!.2i", $this->attributes['price_netto'] * 1.23));
	}


	/**
	 * Generuje unikatowy numer RMA
	 * @return String
	 */
	public function generateRMA()
	{
		return 'RMA' . date('dmYHis');
	}

	/**
	 * Zamienia odpowiednie pola na duze litery
	 * @param  Array
	 * @return Array
	 */
	public function prepareForInsert($input = null) {
		if (!isset($input))
		{
			return false;
		}
		else
		{
			$tmp = array();
			foreach ($input as $key => $value){
				$tmp[$key] = mb_strtoupper($value);
			}
			return array_replace($this->getAttributes(), $tmp);
		}
	}

	/**
	 * Zwraca przeszukana kolekce Order
	 * @param  string $term 	Czego szukamy
	 * @param  string $order 	Jaka jest kolejnosc
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	public function getSearchQuery($term = '', $order = 'ASC', $status = '', $branch = '')
	{
		return $this->where('rma_number', 'LIKE', '%'. $term. '%')
					->orWhere('item', 'LIKE', '%'. $term. '%')
					->orWhere('serial_number', 'LIKE', '%'. $term. '%')
					->orWhere('pa_fv', 'LIKE', '%'. $term. '%')
					->orWhere('ext_service', 'LIKE', '%'. $term. '%')
					->orWhere('client', 'LIKE', '%'. $term. '%')
					->orWhere('client_phone', 'LIKE', '%'. $term. '%')
					->orWhere('description', 'LIKE', '%'. $term. '%')
					->orWhere('diagnose', 'LIKE', '%'. $term. '%')
					->orWhere('comments', 'LIKE', '%'. $term. '%')
					->orWhere('accesories', 'LIKE', '%'. $term. '%')
					->where('status_id', '=', $status)
					->where('branch_id', '=', $branch)
					->orderBy('status_id', $order);
	}


	/**
	 * Zwraca przefiltrowana kolekcje Order
	 * @param  string $status 	Status zlecenia
	 * @param  string $branch 	Oddzial zlecenia
	 * @param  string $order 	Kolejnosc sortowania Id zlecenia
	 * 
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	public function getFilteredResults($status = null, $branch = null, $user = null, $order = 'DESC')
	{
		if (empty($order)) $order = 'DESC';

		return $this->with('status')->with('branch')
			->where(function($query) use ($status, $branch, $user) {
				if (!empty($status)) $query->where('status_id', '=', $status);
				if (!empty($branch)) $query->where('branch_id', '=', $branch);
				if (!empty($user)) $query->where('user_id', '=', $user);
			})->orderBy('status_id', 'ASC')->orderBy('id', $order);
	}

	/**
	 * Zwraca liste pol zmienionych podczas edycji itp. jako String przydatne
	 * do budowania historii
	 *
	 * @param array $before		Tablica pol przed zmiana
	 * @param array $after		Tablica pol po zmianie
	 * @return String
	 */
	public function getModifiedAttributes(array $before, array $after) {
		$keys = array_keys(array_diff_assoc($after, $before));
		$combined = array_combine($keys, $keys);
		return $result = implode(', ', array_values(array_intersect_key(self::$named_fields, $combined)));
	}

	/**
	 * Relacje z innymi Modelami
	 */

	/**
	 * Relacja z modelem User
	 * @return Relation
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	// Orders __belongs_to_many__ Statuses
	public function status()
	{
		return $this->belongsToMany('Status');
	}

	// Orders __belongs_to_many__ Branches
	public function branch()
	{
		return $this->belongsToMany('Branch');
	}

	/**
	 * Relacja z modele History
	 * @return relation
	 */
	public function history()
	{
		return $this->morphMany('History', 'historable');
	}
}
