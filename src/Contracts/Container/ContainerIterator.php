<?php

declare(strict_types=1);

namespace Philly\Contracts\Container;

use Iterator;

/**
 * Interface ContainerIterator.
 *
 * @template TValue
 *
 * @extends Iterator<TValue>
 */
interface ContainerIterator extends Iterator
{
}
