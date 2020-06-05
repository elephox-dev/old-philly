<?php
declare(strict_types=1);

namespace Philly;

use Philly\Container\BindingContainer;
use Philly\Contracts\App as AppContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Exceptions\ExceptionHandler;
use Philly\ServiceProvider\ServiceProviderContainer;

/**
 * Class App
 */
class App extends BindingContainer implements AppContract
{
	/**
	 * App constructor.
	 */
	public function __construct()
	{
		// bind this app instance to its own class
		$this[AppContract::class] = $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getExceptionHandler(): ExceptionHandlerContract
	{
		$handler = $this->getLazy(
			ExceptionHandlerContract::class,
			fn() => new ExceptionHandler(),
			true
		);

		assert(
			$handler instanceof ExceptionHandlerContract,
			"Invalid exception handler type!"
		);

		return $handler;
	}

	/**
	 * @inheritDoc
	 */
	public function getServices(): ServiceProviderContainerContract
	{
		$serviceContainer = $this->getLazy(
			ServiceProviderContainerContract::class,
			fn () => new ServiceProviderContainer(),
			true
		);

		assert(
			$serviceContainer instanceof ServiceProviderContainerContract,
			"Invalid service provider container type!"
		);

		return $serviceContainer;
	}
}
