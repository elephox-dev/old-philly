<?php

declare(strict_types=1);

namespace Philly\Contracts\Queue;

use Iterator;

/**
 * Interface QueueIterator.
 *
 * @template TValue
 *
 * @extends Iterator<TValue>
 */
interface QueueIterator extends Iterator
{
}
