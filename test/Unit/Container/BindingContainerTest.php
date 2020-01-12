<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use Philly\Container\BindingContainer;
use PHPUnit\Framework\TestCase;

/**
 * Class BindingContainerTest
 */
class BindingContainerTest extends TestCase
{
    public function testBindBuilder()
    {
        $container = new BindingContainer();
        $container->bind(TestInterface::class, function () {
            return new TestClass();
        });

        $instance_a = $container[TestInterface::class];

        static::assertTrue($instance_a instanceof TestClass);

        $instance_b = $container[TestInterface::class];

        static::assertFalse($instance_a === $instance_b);
    }

    public function testBindSingletonBuilder()
    {
        $container = new BindingContainer();
        $container->bind(TestInterface::class, function () {
            return new TestClass();
        }, true);

        static::assertTrue($container[TestInterface::class] instanceof TestClass);

        $instance_a = $container[TestInterface::class];
        $instance_b = $container[TestInterface::class];

        static::assertTrue($instance_a === $instance_b);
    }

    public function testBindSingletonInstance()
    {
        $instance_a = new TestClass();
        $container = new BindingContainer();
        $container->bind(TestInterface::class, $instance_a, true);

        static::assertTrue($container[TestInterface::class] instanceof TestClass);

        $instance_b = $container[TestInterface::class];
        $instance_c = $container[TestInterface::class];

        static::assertTrue($instance_a === $instance_b);
        static::assertTrue($instance_b === $instance_c);
    }
}
