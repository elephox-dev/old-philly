<?php
declare(strict_types=1);

namespace Philly\Container;

use Philly\Contracts\Container\Container as ContainerContract;
use Philly\Contracts\Container\ContainerIterator as ContainerIteratorContract;

/**
 * Class Container
 */
abstract class Container implements ContainerContract
{
    /**
     * The internal storage for this container
     * @var array
     */
    protected array $storage = [];

    /**
     * Container constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->storage = $items;
    }

    /**
     * @inheritDoc
     */
    public function getKeys(): array
    {
        return array_keys($this->storage);
    }

    /**
     * @inheritDoc
     */
    public function getValues(): array
    {
        return array_values($this->storage);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->storage);
    }

    /**
     * @inheritDoc
     * @throws OffsetNotFoundException
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset))
            throw new OffsetNotFoundException("Offset '$offset' does not exist!");

        return $this->storage[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if (!$this->accepts($value))
            throw new UnacceptableTypeException("Cannot accept objects of type '" . get_class($value) . "'");

        $this->storage[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        unset($this->storage[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): ContainerIteratorContract
    {
        return new ContainerIterator($this);
    }

    /**
     * Returns this container as a json object.
     */
    public function jsonSerialize(): array
    {
        return $this->storage;
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @inheritDoc
     */
    public function has($id)
    {
        return $this->offsetExists($id);
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value): void
    {
        $this->offsetSet($key, $value);
    }

    /**
     * Check whether this container accepts the given value. This method should be overridden for implementations that
     * check the types of values added to this container.
     *
     * @param mixed $value
     */
    public function accepts($value): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getLazy($key, $default)
    {
        if ($this->has($key))
            /** @noinspection PhpUnhandledExceptionInspection */
            return $this->offsetGet($key);

        $this->offsetSet($key, $default);

        return $default;
    }
}
