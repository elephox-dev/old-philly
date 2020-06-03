<?php
declare(strict_types=1);

namespace test\Philly\Unit;


use Philly\App;
use Philly\Contracts\Container\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
	public function testGetExceptionHandler()
	{
		$app = new App();

		$handler = $app->getExceptionHandler();

		static::assertInstanceOf(ExceptionHandlerContract::class, $handler);
	}

	public function testGetServices()
	{
		$app = new App();

		$handler = $app->getServices();

		static::assertInstanceOf(ServiceProviderContainerContract::class, $handler);
	}
}
