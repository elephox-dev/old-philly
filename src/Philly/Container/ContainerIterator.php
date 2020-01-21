<?php
declare(strict_types=1);

namespace Philly\Container;

use OutOfBoundsException;
use Philly\Contracts\Container\ContainerIterator as BaseContainerIterator;

/**
 * Class ContainerIterator
 */
class ContainerIterator implements BaseContainerIterator
{
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * @var array
     */
    protected array $keys;

    /**
     * @var int
     */
    protected int $current_key = 0;

    /**
     * ContainerIterator constructor.
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->keys = $container->getKeys();
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        $offset = $this->key();
        if ($offset !== null)
            return $this->container[$offset];

        throw new OutOfBoundsException("No more keys available!");
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->current_key++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        if ($this->current_key < count($this->keys))
            return $this->keys[$this->current_key];

        return null;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return count($this->keys) > $this->current_key;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->current_key = 0;
    }
}
