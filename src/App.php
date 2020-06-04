<?php
declare(strict_types=1);

namespace Philly;

use Philly\Container\BindingContainer;
use Philly\ServiceProvider\ServiceProviderContainer;
use Philly\Contracts\App as AppContract;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\Routing\RouteContainer as RouteContainerContract;
use Philly\Exceptions\ExceptionHandler;
use Philly\Routing\RouteContainer;

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
		parent::__construct();

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

	public function getRoutes(): RouteContainerContract
	{
		$routeContainer = $this->getLazy(
			RouteContainerContract::class,
			fn () => new RouteContainer(),
			true
		);

		assert(
			$routeContainer instanceof RouteContainerContract,
			"Invalid route container provider type!"
		);

		return $routeContainer;
	}
}
