<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;


use Philly\Contracts\Container\Collection as CollectionContract;

/**
 * Interface FiltersTypes.
 *
 * @mixin Container
 */
interface FiltersTypes
{
	/**
	 * Filters the contents of a container by a specific interface.
	 *
	 * @param string|object $interface The interface name or instance of the interface to filter by.
	 * @return CollectionContract A new collection containing the filtered items.
	 */
	public function getInstancesOf($interface): CollectionContract;
}
