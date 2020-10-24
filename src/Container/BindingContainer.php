<?php

declare(strict_types=1);

namespace Philly\Container;

use Closure;
use InvalidArgumentException;
use Philly\Contracts\Container\BindingContainer as BindingContainerContract;
use Philly\Contracts\Container\BindingContract as BaseBindingContract;

/**
 * Class BindingContainer.
 *
 * @extend Container<class-string, BindingContract>
 *
 * @iterable<class-string, BaseBindingContract>
 */
class BindingContainer extends Container implements BindingContainerContract
{
    /**
     * @var array<class-string, BindingContract> This array contains the singleton instances which were already built
     */
    protected array $singletons = [];

    /**
     * Container constructor.
     *
     * @param array<class-string, BaseBindingContract> $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct();

        /** @var BaseBindingContract $contract */
        foreach ($items as $contract) {
            $interface = $contract->getInterface();

            if (strlen($interface) == 0) {
                throw new InvalidArgumentException("Binding contract interface must be set!");
            }

            if (parent::offsetExists($interface)) {
                throw new InvalidArgumentException("A contract using this interface has already been bound: $interface");
            }

            parent::offsetSet($interface, $contract);
        }
    }

    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof BaseBindingContract;
    }

    /**
     * @inheritDoc
     */
    public function acceptsKey($offset): bool
    {
        return is_string($offset);
    }

    /**
     * @inheritDoc
     */
    public function acceptsBinding($value): bool
    {
        return is_object($value);
    }

    /**
     * @inheritDoc
     */
    public function bind(string $interface, $builder, bool $singleton = false): BaseBindingContract
    {
        if ($builder instanceof Closure) {
            $contract_builder = $builder;
        } else {
            $this->verifyAcceptable($builder);

            $contract_builder = /** @return mixed */ fn () => $builder;
        }

        $contract = new BindingContract($interface, $contract_builder, $singleton);

        parent::offsetSet($interface, $contract);

        return $contract;
    }

    /**
     * Offset to set
     *
     * @param class-string $offset The offset to assign the value to.
     * @param mixed|BaseBindingContract $value The value to set or the contract to bind.
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null || !is_string($offset)) {
            throw new InvalidArgumentException("Offset must be a string!");
        }

        if (parent::offsetExists($offset)) {
            throw new InvalidArgumentException("Offset $offset already bound!");
        }

        if ($value instanceof BaseBindingContract) {
            parent::offsetSet($offset, $value);
        } else {
            $this->bind($offset, $value, true);
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        $contract = parent::offsetGet($offset);

        if (!($contract instanceof BaseBindingContract)) {
            throw new UnacceptableTypeException("Invalid binding contract!");
        }

        $builder = $contract->getBuilder();

        if (!$contract->isSingleton()) {
            return $this->verifyAcceptable($builder());
        }

        $interface = $contract->getInterface();

        if (array_key_exists($interface, $this->singletons)) {
            return $this->singletons[$interface];
        }

        return $this->singletons[$interface] = $this->verifyAcceptable($builder());
    }

    /**
     * Checks if this container accepts the provided instance as a binding. Throws an exception if the given type is not
     * acceptable.
     *
     * @template T
     *
     * @param T $instance The instance to check.
     *
     * @throws UnacceptableBindingException If the given type is not acceptable for binding.
     *
     * @return T The given instance.
     */
    private function verifyAcceptable($instance)
    {
        if (!$this->acceptsBinding($instance)) {
            if (is_object($instance)) {
                $type = get_class($instance);
            } else {
                $type = gettype($instance);
            }

            throw new UnacceptableBindingException($type);
        }

        return $instance;
    }

    /**
     * @inheritDoc
     */
    public function getLazy($key, $default)
    {
        if (!$this->offsetExists($key)) {
            if (!is_string($key)) {
                $type = gettype($key);

                throw new InvalidArgumentException("Key has invalid type: $type. Only strings can be used as keys.");
            }

            $this->bind($key, $default, false);
        }

        return $this->offsetGet($key);
    }

    /**
     * @inheritDoc
     */
    public function getLazySingleton($key, $default)
    {
        if (!$this->offsetExists($key)) {
            if (!is_string($key)) {
                $type = gettype($key);

                throw new InvalidArgumentException("Key has invalid type: $type. Only strings can be used as keys.");
            }

            $this->bind($key, $default, true);
        }

        return $this->offsetGet($key);
    }
}
