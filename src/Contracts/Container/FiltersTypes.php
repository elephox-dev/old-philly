<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;


use Philly\Contracts\Container\Collection as CollectionContract;

/**
 * Interface FiltersTypes.
 */
interface FiltersTypes
{
	public function getInstancesOf($interface): CollectionContract;
}
