<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;


use PHPUnit\Framework\TestCase;
use test\Philly\SecondTestClass;
use test\Philly\SecondTestInterface;
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
		$instance2 = new SecondTestClass();

		$container[] = $instance;
		$container[] = $instance2;
		$instances = $container->getInstancesOf(SecondTestInterface::class);

		static::assertCount(1, $instances);
		static::assertSame($instance2, $instances[0]);
	}
}
