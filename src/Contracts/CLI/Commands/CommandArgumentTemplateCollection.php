<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;

use Philly\Contracts\Container\Collection;

/**
 * Interface CommandArgumentTemplateCollection.
 */
interface CommandArgumentTemplateCollection extends Collection
{
    /**
     * Filters the collection to find a specific key. If an item is found, the value is returned. If not then a default
     * value will be returned. If no callback is given then this method returns the first element in this collection or
     * null if this collection is empty.
     *
     * @param mixed $key The key to look for.
     * @param mixed|null $default A default value to return in case no entry is accepted.
     * @return mixed|null The first item that got matched by the callback or null if no item matched.
     */
    public function firstKey($key, $default = null);
}
