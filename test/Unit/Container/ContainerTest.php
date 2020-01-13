<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use Philly\Container\OffsetNotFoundException;
use Philly\Container\UnacceptableTypeException;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class ContainerTest.
 */
class ContainerTest extends TestCase
{
    public function testGetValues()
    {
        $instance = new TestClass();

        $container = new TestContainer();
        $container[TestInterface::class] = $instance;

        $values = $container->getValues();

        static::assertIsArray($values);
        static::assertContains($instance, $values);
    }

    public function testGetKeys()
    {
        $key = TestInterface::class;

        $container = new TestContainer();
        $container[$key] = new TestClass();

        $keys = $container->getKeys();

        static::assertIsArray($keys);
        static::assertContains($key, $keys);
    }

    public function testOffsetSet()
    {
        $instance = new TestClass();
        $container = new TestContainer();
        $container->offsetSet(TestInterface::class, $instance);

        $got = $container[TestInterface::class];

        static::assertTrue($instance === $got);
    }

    public function testOffsetGet()
    {
        $instance = new TestClass();
        $container = new TestContainer();
        $container[TestInterface::class] = $instance;

        /** @noinspection PhpUnhandledExceptionInspection */
        $got = $container->offsetGet(TestInterface::class);

        static::assertTrue($instance === $got);
    }

    public function testOffsetUnset()
    {
        $container = new TestContainer();
        $container[TestInterface::class] = new TestClass();

        $container->offsetUnset(TestInterface::class);

        static::expectException(OffsetNotFoundException::class);

        /** @noinspection PhpUnusedLocalVariableInspection */
        $got = $container[TestInterface::class];
    }

    public function testAccepts()
    {
        $instance = new TestClass();
        $container = new TestContainer();
        $container[TestInterface::class] = $instance;

        static::assertContains($instance, $container);

        static::expectException(UnacceptableTypeException::class);
        $container[stdClass::class] = new stdClass();
    }

    public function testJsonSerialize()
    {
        $instance = new TestClass();
        $container = new TestContainer();
        $container[TestInterface::class] = $instance;
        $json = json_encode($container, $container->jsonOptions());

        static::assertEquals("{\"test\\\\Philly\\\\Unit\\\\Container\\\\TestInterface\":{\"field\":\"value\"}}", $json);
    }

    public function testGet()
    {
        $instance = new TestClass();
        $container = new TestContainer();
        $container[TestInterface::class] = $instance;

        $got = $container->get(TestInterface::class);

        static::assertTrue($instance === $got);
    }

    public function testHas()
    {
        $container = new TestContainer();
        $container[TestInterface::class] = new TestClass();

        static::assertTrue($container->has(TestInterface::class));
    }

    public function testOffsetExists()
    {
        $container = new TestContainer();
        $container[TestInterface::class] = new TestClass();

        static::assertTrue($container->offsetExists(TestInterface::class));
    }

    public function testPut()
    {
        $instance = new TestClass();
        $container = new TestContainer();
        $container->put(TestInterface::class, $instance);

        $got = $container[TestInterface::class];

        static::assertTrue($instance === $got);
    }
}
