<?php

declare(strict_types=1);

namespace Philly\Container;

use Philly\Contracts\Container\Collection as CollectionContract;

/**
 * Trait FiltersTypes
 *
 * @mixin Container
 * @mixin \Philly\Contracts\Container\FiltersTypes
 */
trait FiltersTypes
{
    /**
     * @inheritDoc
     */
    public function getInstancesOf($interface): CollectionContract
    {
        $result = new Collection();
        foreach ($this->getValues() as $value) {
            if (is_object($value) && $value instanceof $interface) {
                $result->add($value);
            }
        }

        return $result;
    }
}
