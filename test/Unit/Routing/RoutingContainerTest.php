<?php
declare(strict_types=1);

namespace test\Philly\Unit\Routing;


use Philly\Contracts\Routing\Route as RouteContract;
use Philly\Routing\RouteContainer;
use PHPUnit\Framework\TestCase;
use test\Philly\TestRoute;

class RoutingContainerTest extends TestCase
{
	public function testAcceptsRoute()
	{
		$container = new RouteContainer();
		$container["test"] = new TestRoute();

		static::assertInstanceOf(RouteContract::class, $container["test"]);
	}
}
