<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;


use PHPUnit\Framework\TestCase;
use test\Philly\TestClass;
use test\Philly\TestContainer;
use test\Philly\TestInterface;

/**
 * Class FiltersTypesTest
 */
class FiltersTypesTest extends TestCase
{
	public function testGetInstancesOf()
	{
		$container = new TestContainer();
		$instance = new TestClass();

		$container[] = $instance;
		$instances = $container->getInstancesOf(TestInterface::class);

		static::assertCount(1, $instances);
		static::assertSame($instance, $instances[0]);
	}
}
