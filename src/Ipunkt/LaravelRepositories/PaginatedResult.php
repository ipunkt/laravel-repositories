<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 17.03.14
 * Time: 08:54
 */

namespace Ipunkt\LaravelRepositories;


use Illuminate\Database\Eloquent\Collection;
use Ipunkt\LaravelRepositories\Contracts\PaginatedInterface;

class PaginatedResult implements PaginatedInterface {

	/**
	 * current page
	 *
	 * @var int
	 */
	protected $page = 1;

	/**
	 * current limit
	 *
	 * @var int
	 */
	protected $limit = 10;

	/**
	 * total items count
	 *
	 * @var int
	 */
	protected $totalItems = 0;

	/**
	 * items
	 *
	 * @var Collection
	 */
	protected $items;

	/**
	 * creates an instance of the paginated result
	 *
	 * @param int $page
	 * @param int $limit
	 * @param int $totalItems
	 * @param Collection $items
	 */
	public function __construct($page, $limit, $totalItems, $items)
	{
		$this->page = $page;
		$this->limit = $limit;
		$this->totalItems = $totalItems;
		$this->items = $items;
	}

	/**
	 * returns current page
	 *
	 * @return int
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * returns current limit
	 *
	 * @return int
	 */
	public function getLimit()
	{
		return $this->limit;
	}

	/**
	 * returns total items
	 *
	 * @return int
	 */
	public function getTotalItems()
	{
		return $this->totalItems;
	}

	/**
	 * returns items for page
	 *
	 * @return Collection
	 */
	public function getItems()
	{
		if ($this->items === null)
			return new Collection();

		return $this->items;
	}
}