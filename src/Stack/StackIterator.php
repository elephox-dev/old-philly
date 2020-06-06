<?php

declare(strict_types=1);

namespace Philly\Stack;

use Philly\Contracts\Stack\StackIterator as StackIteratorContract;

/**
 * Class StackIterator.
 */
class StackIterator implements StackIteratorContract
{
    protected Stack $stack;

    /**
     * StackIterator constructor.
     */
    public function __construct(Stack $stack)
    {
        $this->stack = $stack;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->stack->peek();
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->stack->pop();
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

        return $this->stack->count() - 1;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return !$this->stack->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        // do nothing
    }
}
