<?php

declare(strict_types=1);

namespace Philly\Queue;

use Philly\Contracts\Queue\Queue as QueueContract;
use Philly\Contracts\Queue\QueueIterator as QueueIteratorContract;
use Philly\Support\Storage;

/**
 * Class Queue.
 *
 * @template TValue
 *
 * @implements Storage<int, TValue>
 *
 * @iterable<TValue>
 */
class Queue extends Storage implements QueueContract
{
    /**
     * Queue constructor.
     *
     * @param TValue ...$items The initial items in this queue.
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): QueueIteratorContract
    {
        return new QueueIterator($this);
    }

    /**
     * @inheritDoc
     */
    public function enqueue(...$value): void
    {
        array_push($this->storage, ...$value);
    }

    /**
     * @inheritDoc
     */
    public function dequeue()
    {
        $value = array_shift($this->storage);
        if ($value === null) {
            throw new QueueEmptyException();
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function head()
    {
        $value = reset($this->storage);
        if ($value === false) {
            throw new QueueEmptyException();
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function tail()
    {
        $value = end($this->storage);
        if ($value === false) {
            throw new QueueEmptyException();
        }

        return $value;
    }
}
