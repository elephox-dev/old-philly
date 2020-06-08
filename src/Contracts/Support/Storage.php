<?php

declare(strict_types=1);

namespace Philly\Contracts\Support;

use Countable;

/**
 * Interface Storage.
 *
 * @template TKey as array-key
 * @phpstan-template TKey
 * @template TValue
 *
 * @iterable<TKey, TValue>
 */
interface Storage extends Countable, JsonCompatible
{
    /**
     * @return bool Whether this storage is empty.
     */
    public function isEmpty(): bool;

    /**
     * @inheritDoc
     */
    public function count(): int;

    /**
     * Clears the storage.
     */
    public function clear(): void;
}
