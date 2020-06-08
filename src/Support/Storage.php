<?php

declare(strict_types=1);

namespace Philly\Support;

use Philly\Contracts\Support\Storage as StorageContract;

/**
 * Class Storage
 *
 * @template TKey of array-key
 * @phpstan-template TKey
 * @template TValue
 *
 * @implements StorageContract<TKey, TValue>
 */
class Storage implements StorageContract
{
    use JsonCompatible;

    /** @var array<TKey, TValue> $storage The internal storage. */
    protected array $storage;

    /**
     * Storage constructor.
     *
     * @param array<TKey, TValue> $items The array of initial items for this storage.
     */
    protected function __construct(array $items = [])
    {
        $this->storage = $items;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->count() == 0;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->storage);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->storage;
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        unset($this->storage);

        $this->storage = [];
    }
}
