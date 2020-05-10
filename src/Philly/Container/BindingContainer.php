<?php
declare(strict_types=1);

namespace Philly\Container;

use InvalidArgumentException;
use Philly\Contracts\Container\BindingContainer as BindingContainerContract;
use Philly\Contracts\Container\BindingContract as BaseBindingContract;

/**
 * Class BindingContainer
 */
class BindingContainer extends Container implements BindingContainerContract
{
    /**
     * This array contains the singleton instances which were already built
     * @var array
     */
    protected array $singletons = [];

    /**
     * Container constructor.
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }

    /**
     * @inheritDoc
     */
    public function bind(string $interface, $builder, bool $singleton = false): BaseBindingContract
    {
        if (!is_callable($builder)) {
            $this->singletons[$interface] = $builder;

            $contract = new BindingContract($interface, function () use ($builder) {
                return $builder;
            }, true);
        } else
            $contract = new BindingContract($interface, $builder, $singleton);

        parent::offsetSet($interface, $contract);

        return $contract;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null)
            throw new InvalidArgumentException("Offset cannot be null!");

        return $this->bind($offset, $value, true);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        $contract = parent::offsetGet($offset);

        assert($contract instanceof BaseBindingContract, "Invalid binding contract!");

        $builder = $contract->getBuilder();

        if (!$contract->isSingleton())
            return $builder();

        if (array_key_exists($contract->getInterface(), $this->singletons))
            return $this->singletons[$contract->getInterface()];

        $instance = $builder();

        $this->singletons[$contract->getInterface()] = $instance;

        return $instance;
    }
}
