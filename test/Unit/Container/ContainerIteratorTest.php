<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use Philly\Container\ContainerIterator;
use PHPUnit\Framework\TestCase;

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

        /** @noinspection PhpUnhandledExceptionInspection */
        $it = $container->getIterator();

        while ($it->valid()) {
            static::assertTrue($it->current() instanceof TestClass);
            static::assertContains($it->key(), [TestInterface::class, TestClass::class]);
            $it->next();
        }

        $it->rewind();

        static::assertTrue($it->valid());
    }
}
