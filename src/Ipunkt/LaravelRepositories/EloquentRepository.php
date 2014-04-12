<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 17.03.14
 * Time: 08:28
 */

namespace Ipunkt\LaravelRepositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Ipunkt\LaravelRepositories\Contracts\PaginatedInterface;
use Ipunkt\LaravelRepositories\Contracts\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface {

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * with eager loadings
	 *
	 * @var array
	 */
	protected $with = array();

	/**
	 * returns a collection of all models
	 *
	 * @return Collection
	 */
	public function all()
	{
		return $this->model->all();
	}

	/**
	 * returns the model found
	 *
	 * @param int $id
	 * @return Model
	 */
	public function find($id)
	{
		$query = $this->make();

		return $query->find($id);
	}

	/**
	 * returns the repository itself, for fluent interface
	 *
	 * @param array $with
	 * @return self
	 */
	public function with(array $with)
	{
		$this->with = array_merge($this->with, $with);
		
		return $this;
	}

	/**
	 * returns the first model found by conditions
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param string $operator
	 * @return Model
	 */
	public function findFirstBy($key, $value, $operator = '=')
	{
		$query = $this->make();

		return $query->where($key, $operator, $value)->first();
	}

	/**
	 * returns all models found by conditions
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param string $operator
	 * @return Collection
	 */
	public function findAllBy($key, $value, $operator = '=')
	{
		$query = $this->make();

		return $query->where($key, $operator, $value)->get();
	}

	/**
	 * returns all models that have a required relation
	 *
	 * @param string $relation
	 * @return Collection
	 */
	public function has($relation)
	{
		$query = $this->make();

		return $query->has($relation)->get();
	}

	/**
	 * returns paginated result
	 *
	 * @param int $page
	 * @param int $limit
	 * @return PaginatedInterface
	 */
	public function getPaginated($page = 1, $limit = 10)
	{
		$query = $this->make();
		$collection = $query->forPage($page, $limit)->get();

		return new PaginatedResult($page, $limit, $collection->count(), $collection);
	}


	/**
	 * returns the query builder with eager loading, or the model itself
	 *
	 * @return Builder|Model
	 */
	protected function make()
	{
		return $this->model->with($this->with);
	}
} 
