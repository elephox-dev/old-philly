<?php

declare(strict_types=1);

namespace Philly\Stack;

use Philly\Contracts\Stack\Stack as StackContract;
use Philly\Contracts\Stack\StackIterator as StackIteratorContract;
use Philly\Support\Storage;

/**
 * Class Stack.
 *
 * @template TValue
 *
 * @implements Storage<int, TValue>
 *
 * @iterable<TValue>
 */
class Stack extends Storage implements StackContract
{
    /**
     * Stack constructor.
     *
     * @param TValue ...$items The initial items in this stack.
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): StackIteratorContract
    {
        return new StackIterator($this);
    }

    /**
     * @inheritDoc
     */
    public function push(...$value): void
    {
        array_push($this->storage, ...$value);
    }

    /**
     * @inheritDoc
     */
    public function pop()
    {
        $value = array_pop($this->storage);
        if ($value === null) {
            throw new StackEmptyException();
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function peek()
    {
        $value = end($this->storage);
        if ($value === false) {
            throw new StackEmptyException();
        }

        return $value;
    }
}
