<?php
declare(strict_types=1);

namespace Philly\Container;


use Philly\Collection\Collection;
use Philly\Contracts\Collection\Collection as CollectionContract;

/**
 * Trait FiltersTypes
 *
 * @mixin Container
 */
trait FiltersTypes
{
    /**
     * @param string $interface
     */
    public function getInstancesOf(string $interface): CollectionContract
    {
        $result = new Collection();
        foreach ($this->getValues() as $value)
            if (is_object($value) && $value instanceof $interface)
                $result->add($value);

        return $result;
    }
}
