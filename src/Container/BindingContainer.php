<?php
declare(strict_types=1);

namespace Philly\Container;

use Closure;
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
    public function accepts($value): bool
    {
    	return $value instanceof BaseBindingContract;
    }

	/**
     * @inheritDoc
     */
    public function bind(string $interface, $builder, bool $singleton = false): BaseBindingContract
    {
    	if ($builder === null)
    		throw new InvalidArgumentException("Builder cannot be null!");

	    if ($builder instanceof Closure)
		    $contract_builder = $builder;
	    else
		    $contract_builder = /** @return mixed */ fn() => $builder;

	    $contract = new BindingContract($interface, $contract_builder, $singleton);

        parent::offsetSet($interface, $contract);

        return $contract;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $contract)
    {
        if ($offset === null)
            throw new InvalidArgumentException("Offset cannot be null!");

        if (!is_string($offset))
        	throw new InvalidArgumentException("Offset must be a string!");

        $this->bind($offset, $contract, true);
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

	/**
	 * @inheritDoc
	 */
	public function getLazy($key, $default, bool $singleton = false)
	{
		if (!$this->offsetExists($key)) {
			if (!is_string($key)) {
				$type = gettype($key);

				throw new InvalidArgumentException("Key has invalid type: $type. Only strings can be used as keys.");
			}

			$this->bind($key, $default, $singleton);
		}

		/** @noinspection PhpUnhandledExceptionInspection */
		return $this->offsetGet($key);
	}
}
