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
     * @var string|float|int|bool|null
     */
    protected $current_offset;

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

        if (count($this->keys) > 0)
            $this->current_offset = $this->keys[0];
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        if ($this->current_offset != null)
            return $this->container[$this->current_offset];

        throw new OutOfBoundsException("Container does not contains any elements.");
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        ++$this->current_key;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        if ($this->current_key < count($this->keys))
            return $this->current_offset;

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
