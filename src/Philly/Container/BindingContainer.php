<?php
declare(strict_types=1);

namespace Philly\Container;

use InvalidArgumentException;
use Philly\Contracts\Container\BindingContainer as BaseBindingContainer;
use Philly\Contracts\Container\BindingContract as BaseBindingContract;

/**
 * Class BindingContainer
 */
class BindingContainer extends Container implements BaseBindingContainer
{
    /**
     * This array contains the singleton instances which were already built
     * @var array
     */
    protected array $singletons = [];

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
        /** @var BindingContract $contract */
        $contract = parent::offsetGet($offset);
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
