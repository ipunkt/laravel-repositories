<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 17.03.14
 * Time: 08:26
 */

namespace Ipunkt\LaravelRepositories\Contracts;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {

	/**
	 * returns a collection of all models
	 *
	 * @return Collection
	 */
	public function all();

	/**
	 * returns the model found
	 *
	 * @param int $id
	 * @return Model
	 */
	public function find($id);

	/**
	 * returns the repository itself, for fluent interface
	 *
	 * @param array $with
	 * @return self
	 */
	public function with(array $with);

	/**
	 * returns the first model found by conditions
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param string $operator
	 * @return Model
	 */
	public function findFirstBy($key, $value, $operator = '=');

	/**
	 * returns all models found by conditions
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param string $operator
	 * @return Collection
	 */
	public function findAllBy($key, $value, $operator = '=');

	/**
	 * returns all models that have a required relation
	 *
	 * @param string $relation
	 * @return Collection
	 */
	public function has($relation);

	/**
	 * @param int $page
	 * @param int $limit
	 * @return PaginatedInterface
	 */
	public function getPaginated($page = 1, $limit = 10);
}