<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use InvalidArgumentException;
use Philly\Container\BindingContainer;
use Philly\Container\BindingContract;
use PHPUnit\Framework\TestCase;
use test\Philly\SecondTestClass;
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

    public function testInitializeWithValues()
    {
    	$contract = new BindingContract(TestInterface::class, fn() => new TestClass(), true);
    	$container = new BindingContainer([$contract]);

    	$result = $container[TestInterface::class];

    	static::assertInstanceOf(TestClass::class, $result);
    }

    public function testInitializeWithDuplicate()
    {
    	$contracts = [
    		new BindingContract(TestInterface::class, fn() => new TestClass(), true),
    		new BindingContract(TestInterface::class, fn() => new SecondTestClass(), true)
	    ];

    	static::expectException(InvalidArgumentException::class);

    	new BindingContainer($contracts);
    }

    public function testInitializeWithNullValue()
    {
	    $contract = new BindingContract("", fn() => null, false);

	    static::expectException(InvalidArgumentException::class);

	    new BindingContainer([$contract]);
    }

    public function testOffsetSetBindingContract()
    {
    	$contract = new BindingContract(TestInterface::class, fn() => new TestClass(), true);
    	$container = new BindingContainer();

    	$container->offsetSet(TestInterface::class, $contract);

		$instance = $container[TestInterface::class];

		static::assertInstanceOf(TestClass::class, $instance);

		$instance2 = $container[TestInterface::class];

		static::assertSame($instance, $instance2);
    }

    public function testOffsetSetNull()
    {
    	$container = new BindingContainer();

    	static::expectException(InvalidArgumentException::class);

    	$container->offsetSet(null, null);
    }

    public function testOffsetSetNonString()
    {
    	$container = new BindingContainer();

    	static::expectException(InvalidArgumentException::class);

    	$container->offsetSet(12, null);
    }

    public function testOffsetSetDuplicate()
    {
    	$container = new BindingContainer();
    	$container->offsetSet(TestInterface::class, new TestClass());

    	static::expectException(InvalidArgumentException::class);

    	$container->offsetSet(TestInterface::class, new SecondTestClass());
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
        $contract = $container->bind(TestInterface::class, fn() => new TestClass(), false);

        $pre_singleton = $container[TestInterface::class];

        $contract->makeSingleton();
        static::assertTrue($contract->isSingleton());

        $post_singleton_a = $container[TestInterface::class];
        $post_singleton_b = $container[TestInterface::class];

        static::assertFalse($pre_singleton === $post_singleton_a);
        static::assertTrue($post_singleton_a === $post_singleton_b);
    }

    public function testGetLazy()
    {
	    $container = new BindingContainer();
	    $instance_a = new TestClass();

	    $instance_b = $container->getLazy(TestInterface::class, $instance_a, false);

	    static::assertSame($instance_a, $instance_b);

	    $instance_c = $container->getLazy(TestInterface::class, new SecondTestClass());

	    static::assertInstanceOf(TestClass::class, $instance_c);
	    static::assertSame($instance_a, $instance_c);
    }

    public function testGetLazyBuilder()
    {
	    $container = new BindingContainer();

	    $instance_a = $container->getLazy(TestInterface::class, fn() => new TestClass(), false);
	    $instance_b = $container->getLazy(TestInterface::class, fn() => new SecondTestClass());

	    static::assertInstanceOf(TestClass::class, $instance_a);
	    static::assertInstanceOf(TestClass::class, $instance_b);
	    static::assertNotSame($instance_a, $instance_b);
    }

    public function testGetLazySingletonBuilder()
    {
	    $container = new BindingContainer();

	    $instance_a = $container->getLazy(TestInterface::class, fn() => new TestClass(), true);
	    $instance_b = $container->getLazy(TestInterface::class, new SecondTestClass());

	    static::assertInstanceOf(TestClass::class, $instance_a);
	    static::assertSame($instance_a, $instance_b);
    }

    public function testGetLazySingleton()
    {
    	$container = new BindingContainer();
    	$instance_a  = new TestClass();

    	$instance_b = $container->getLazy(TestInterface::class, $instance_a, true);

    	static::assertSame($instance_a, $instance_b);

    	$instance_c = $container->getLazy(TestInterface::class, new SecondTestClass());

	    static::assertInstanceOf(TestClass::class, $instance_c);
    	static::assertSame($instance_a, $instance_c);
    }

    public function testGetLazyInvalidKey()
    {
    	$container = new BindingContainer();

    	static::expectException(InvalidArgumentException::class);

    	$container->getLazy(0, null);
    }

    public function testNullBuilder()
    {
	    $container = new BindingContainer();

	    static::expectException(InvalidArgumentException::class);

	    $container->bind(TestInterface::class, null);
    }
}
