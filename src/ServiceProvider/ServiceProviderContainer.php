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
	public function acceptsBinding($value): bool
	{
		return $value instanceof ServiceProviderContract;
	}

	/**
	 * @inheritDoc
	 */
	public function offsetSet($offset, $value)
	{
		parent::offsetSet($offset, $value);

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
