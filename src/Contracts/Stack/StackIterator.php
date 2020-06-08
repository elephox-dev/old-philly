<?php

declare(strict_types=1);

namespace Philly\Contracts\Stack;

use Iterator;

/**
 * Interface StackIterator.
 *
 * @template TKey as array-key
 * @phpstan-template TKey
 * @template TValue
 *
 * @extends Iterator<TKey, TValue>
 */
interface StackIterator extends Iterator
{
}
