<?php

declare(strict_types=1);

namespace Philly\Contracts\Container;

/**
 * Interface Collection.
 *
 * @template TValue
 *
 * @extends Container<int, TValue>
 */
interface Collection extends Container
{
    /**
     * Adds a value to this collection.
     *
     * @param TValue $value The value to add.
     * @return Collection<TValue> The same collection with the value added to the end.
     */
    public function add($value): self;

    /**
     * Filters this collection via a callback and returns a new collection with the new items.
     *
     * @param callable $callback The callback will receive two arguments: the value and the key (in this order).
     *                           If this result evaluates to true, the item is added to the resulting collection.
     * @return Collection<TValue> A new collection containing the filtered items.
     */
    public function where(callable $callback, bool $preserve_keys = true): self;

    /**
     * Filters the collection to find a specific value via a callback. If an item is found, the value is returned. If
     * not then null will be returned. If no callback is given then this method returns the first element in this
     * collection or null if this collection is empty.
     *
     * @param callable|null $callback The callback to use for filtering. The callback receives both the value and then
     *     the key as arguments.
     * @return TValue|null The first item that got matched by the callback or null if no item matched.
     */
    public function first(?callable $callback = null);

    /**
     * Checks if this collection contains a specific value determined by a callback. If not callback is given then this
     * method returns true if there are any elements in this collections.
     *
     * @param callable|null $callback The callback to use for checking. The callback receives both the value and the
     *     key.
     * @return bool Whether this collection contains an item which is matched by the callback or, if no callback is
     *              given, whether this collection contains any element.
     */
    public function any(?callable $callback = null): bool;

    /**
     * @return array<array-key, mixed> Returns a copy of the underlying storage for this collection.
     */
    public function asArray(): array;
}
