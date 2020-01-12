<?php
declare(strict_types=1);

namespace Philly\Container;

use Philly\Contracts\Container\Container as BaseContainer;
use Philly\Contracts\Container\ContainerIterator as ContainerIteratorContract;

/**
 * Class Container
 */
abstract class Container implements BaseContainer
{
    /**
     * The default json options for serialization
     * @var int
     */
    protected int $json_options = JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_QUOT | JSON_THROW_ON_ERROR;

    /**
     * The internal storage for this container
     * @var array
     */
    protected array $storage = [];

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
     */
    public function offsetGet($offset)
    {
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
     *
     * @return false|mixed|string
     */
    public function jsonSerialize()
    {
        return json_encode($this->storage, $this->jsonOptions());
    }

    /**
     * Returns the json encode/decode options for serializing.
     */
    public function jsonOptions(): int
    {
        return $this->json_options;
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
     * Check whether this container accepts the given value.
     *
     * @param mixed $value
     */
    public function accepts($value): bool
    {
        return true;
    }
}
