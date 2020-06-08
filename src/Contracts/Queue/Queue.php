<?php

declare(strict_types=1);

namespace Philly\Contracts\Queue;

use IteratorAggregate;
use Philly\Contracts\Support\Storage;
use Traversable;

/**
 * Interface Queue.
 *
 * @template TValue
 *
 * @implements Storage<int, TValue>
 *
 * @iterable<TValue>
 */
interface Queue extends Traversable, IteratorAggregate, Storage
{
    /**
     * Enqueue a new value into the queue.
     *
     * @param TValue ...$value The value to enqueue.
     */
    public function enqueue(...$value): void;

    /**
     * Dequeue the first value in the queue. This removed the value form the queue.
     *
     * @return TValue The head of the queue.
     */
    public function dequeue();

    /**
     * @return TValue The head of the queue without removing it from the queue.
     */
    public function head();

    /**
     * @return TValue The last element of the queue.
     */
    public function tail();

    /**
     * @inheritDoc
     */
    public function getIterator(): QueueIterator;
}
