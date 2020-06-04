<?php
declare(strict_types=1);

namespace Philly\ServiceProvider;

use Philly\Container\BindingContainer;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Contracts\ServiceProvider\ServiceProvider as ServiceProviderContract;

/**
 * Class ServiceProviderContainer.
 */
class ServiceProviderContainer extends BindingContainer implements ServiceProviderContainerContract
{
	/**
	 * @inheritDoc
	 */
	public function offsetSet($offset, $value)
	{
		parent::offsetSet($offset, $value);

		if (!($value instanceof ServiceProviderContract)) {
			if (is_object($value))
				$type = get_class($value);
			else
				$type = gettype($value);

			throw new UnacceptableTypeException($type);
		}

		$value->onRegistered();
	}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		/** @var ServiceProviderContract $service */
		foreach ($this as $service)
			$service->onBooted();
	}
}
