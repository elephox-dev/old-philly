<?php
declare(strict_types=1);

namespace test\Philly\Unit;


use Philly\App;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\Routing\RouteContainer as RouteContainerContract;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
	public function testGetExceptionHandler()
	{
		$app = new App();

		$handler = $app->getExceptionHandler();

		static::assertInstanceOf(ExceptionHandlerContract::class, $handler);

		$handler2 = $app->getExceptionHandler();

		static::assertSame($handler, $handler2);
	}

	public function testGetServices()
	{
		$app = new App();

		$services = $app->getServices();

		static::assertInstanceOf(ServiceProviderContainerContract::class, $services);

		$services2 = $app->getServices();

		static::assertSame($services, $services2);
	}

	public function testGetRoutes()
	{
		$app = new App();

		$routes = $app->getRoutes();

		static::assertInstanceOf(RouteContainerContract::class, $routes);

		$routes2 = $app->getRoutes();

		static::assertSame($routes, $routes2);
	}
}
