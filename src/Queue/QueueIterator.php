<?php

declare(strict_types=1);

namespace Philly\Queue;

use Philly\Contracts\Queue\QueueIterator as QueueIteratorContract;

/**
 * Class QueueIterator.
 *
 * @template TValue
 *
 * @implements QueueIteratorContract<TValue>
 */
class QueueIterator implements QueueIteratorContract
{
    protected Queue $queue;

    /**
     * QueueIterator constructor.
     */
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->queue->head();
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->queue->dequeue();
    }

    /**
     * @inheritDoc
     *
     * Suppress error until this gets fixed: https://github.com/vimeo/psalm/issues/3531
     * @psalm-suppress NullableReturnStatement
     */
    public function key()
    {
        if (!$this->valid()) {
            return null;
        }

        return 0;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return !$this->queue->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        // do nothing
    }
}
