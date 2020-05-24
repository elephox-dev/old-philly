<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use InvalidArgumentException;
use Philly\Container\BindingContainer;
use PHPUnit\Framework\TestCase;
use test\Philly\TestClass;
use test\Philly\TestInterface;

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

        static::expectException(InvalidArgumentException::class);
        $container->bind(TestInterface::class, null);
    }

    public function testBindSingletonBuilder()
    {
        $container = new BindingContainer();
        $container->bind(TestInterface::class, function () {
            return new TestClass();
        }, true);

        $instance_a = $container[TestInterface::class];
        $instance_b = $container[TestInterface::class];

	    static::assertTrue($instance_a instanceof TestClass);
	    static::assertTrue($instance_a === $instance_b);
    }

    public function testBindSingletonInstance()
    {
        $instance_a = new TestClass();
        $container = new BindingContainer();

        $container->bind(TestInterface::class, $instance_a, true);
        $instance_b = $container[TestInterface::class];
        $instance_c = $container[TestInterface::class];

	    static::assertTrue($instance_a === $instance_b);
        static::assertTrue($instance_b === $instance_c);
    }

    public function testOffsetSet()
    {
        $instance_a = new TestClass();
        $container = new BindingContainer();
        $container->offsetSet(TestInterface::class, $instance_a);

        $instance_b = $container[TestInterface::class];

        static::assertTrue($instance_a === $instance_b);
    }

    public function testOffsetSetNull()
    {
    	$container = new BindingContainer();

    	static::expectException(InvalidArgumentException::class);

    	$container->offsetSet(null, null);
    }

    public function testOffsetGet()
    {
        $instance_a = new TestClass();
        $container = new BindingContainer();
        $container[TestInterface::class] = $instance_a;

        /** @noinspection PhpUnhandledExceptionInspection */
        $instance_b = $container->offsetGet(TestInterface::class);

        static::assertTrue($instance_a === $instance_b);
    }

    public function testMakeSingleton()
    {
        $container = new BindingContainer();
        $contract = $container->bind(TestInterface::class, function () {
            return new TestClass();
        }, false);

        $pre_singleton = $container[TestInterface::class];

        $contract->makeSingleton();
        static::assertTrue($contract->isSingleton());

        $post_singleton_a = $container[TestInterface::class];
        $post_singleton_b = $container[TestInterface::class];

        static::assertFalse($pre_singleton === $post_singleton_a);
        static::assertTrue($post_singleton_a === $post_singleton_b);
    }
}
