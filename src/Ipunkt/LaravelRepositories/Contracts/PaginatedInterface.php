<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 17.03.14
 * Time: 08:52
 */

namespace Ipunkt\LaravelRepositories\Contracts;


use Illuminate\Database\Eloquent\Collection;

interface PaginatedInterface {

	/**
	 * returns current page
	 *
	 * @return int
	 */
	public function getPage();

	/**
	 * returns current limit
	 *
	 * @return int
	 */
	public function getLimit();

	/**
	 * returns total items
	 *
	 * @return int
	 */
	public function getTotalItems();

	/**
	 * returns items for page
	 *
	 * @return Collection
	 */
	public function getItems();

} 