<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;

use ArrayAccess;
use IteratorAggregate;
use JsonSerializable;
use Psr\Container\ContainerInterface;
use Traversable;

/**
 * Interface Container
 */
interface Container extends ContainerInterface, ArrayAccess, Traversable, IteratorAggregate, JsonSerializable
{
    /**
     * Get all keys available in the container.
     */
    function getKeys(): array;

    /**
     * Get all values available in the container.
     */
    function getValues(): array;
}
