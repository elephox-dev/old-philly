<?php

declare(strict_types=1);

namespace Philly\Queue;

use Philly\Contracts\Queue\Queue as QueueContract;
use Philly\Contracts\Queue\QueueIterator as QueueIteratorContract;
use Philly\Support\JsonCompatible;
use UnderflowException;

/**
 * Class Queue.
 */
class Queue implements QueueContract
{
    use JsonCompatible;

    /** @var \Ds\Queue The Data Structures implementation of a queue. */
    protected \Ds\Queue $queue;

    /**
     * Queue constructor.
     */
    public function __construct(array $items = [])
    {
        $this->queue = new \Ds\Queue($items);
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
        $this->queue->push(...$value);
    }

    /**
     * @inheritDoc
     */
    public function dequeue()
    {
        try {
            return $this->queue->pop();
        } catch (UnderflowException $ue) {
            throw new QueueEmptyException($ue->getMessage(), (int)$ue->getCode(), $ue);
        }
    }

    /**
     * @inheritDoc
     */
    public function head()
    {
        try {
            return $this->queue->peek();
        } catch (UnderflowException $ue) {
            throw new QueueEmptyException($ue->getMessage(), (int)$ue->getCode(), $ue);
        }
    }

    /**
     * @inheritDoc
     */
    public function tail()
    {
        $arr = $this->queue->toArray();
        $value = end($arr);
        if ($value === false) {
            throw new QueueEmptyException();
        }

        return $value;
    }

    public function isEmpty(): bool
    {
        return $this->queue->isEmpty();
    }

    public function count(): int
    {
        return $this->queue->count();
    }

    public function clear(): void
    {
        $this->queue->clear();
    }

    public function jsonSerialize()
    {
        return $this->queue->jsonSerialize();
    }
}
