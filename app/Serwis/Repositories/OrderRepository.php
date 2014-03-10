<?php namespace Serwis\Repositories;

use Illuminate\Support\Facades\DB;
use Order;

class OrderRepository implements OrderRepositoryInterface {

	protected $model;

	public function __construct(Order $model)
	{
		$this->model = $model;
	}
	
	public function getAll()
	{
		return $this->model->with('status')->with('branch')->get();
	}

	public function allDates()
	{
		return $this->model->lists('created_at');
	}

	public function orderPerDay()
	{
		return $this->model->orderBy('id', 'DESC')->take(60)->groupBy(DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')'))->get(array(DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\') AS date'), DB::raw('count(*) AS count')))->reverse();
	}
	
	public function orderPerBranch()
	{
		return $this->model->orderBy('id', 'DESC')->take(60)->groupBy('branch_id')->get();
	}
	
	public function orderPerStatus() 
	{
		return $this->model->orderBy('id', 'DESC')->groupBy('status_id')->get(array(DB::raw('status_id AS status'), DB::raw('count(*) AS count')))->reverse();
	}
}