<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use Philly\Container\ContainerIterator;
use PHPUnit\Framework\TestCase;
use test\Philly\SecondTestClass;
use test\Philly\TestClass;
use test\Philly\TestContainer;
use test\Philly\TestInterface;

/**
 * Class ContainerIteratorTest.
 */
class ContainerIteratorTest extends TestCase
{
    public function testIterator()
    {
        $container = new TestContainer();
        $container[TestInterface::class] = new TestClass();
        $container[TestClass::class] = new TestClass();
        $container[SecondTestClass::class] = new SecondTestClass();

        /** @noinspection PhpUnhandledExceptionInspection */
        $it = $container->getIterator();

        while ($it->valid()) {
            static::assertTrue($it->current() instanceof TestClass);
            static::assertContains($it->key(), [TestInterface::class, TestClass::class, SecondTestClass::class]);

            $it->next();
        }

        $it->rewind();

        static::assertTrue($it->valid());
    }
}
