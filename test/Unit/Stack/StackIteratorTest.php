<?php
declare(strict_types=1);

namespace test\Philly\Unit\Stack;

use Philly\Stack\Stack;
use Philly\Stack\StackEmptyException;
use PHPUnit\Framework\TestCase;
use test\Philly\SecondTestClass;
use test\Philly\TestClass;
use test\Philly\TestInterface;

/**
 * Class StackIteratorTest.
 */
class StackIteratorTest extends TestCase
{
    public function testIterator()
    {
        $stack = new Stack();
        $stack->push(new TestClass(), new TestClass(), new SecondTestClass());

        /** @noinspection PhpUnhandledExceptionInspection */
        $it = $stack->getIterator();

        $current = null;
        while ($it->valid()) {
	        static::assertNotSame($current, $it->current());

        	$current = $it->current();

            static::assertTrue($current instanceof TestInterface);
            static::assertIsInt($it->key());
            static::assertGreaterThanOrEqual(0, $it->key());
            static::assertLessThan(3, $it->key());

            $it->next();
        }

        $it->rewind();

        static::assertFalse($it->valid());
        static::assertNull($it->key());
    }

    public function testEmptyException()
    {
    	$stack = new Stack();

	    /** @noinspection PhpUnhandledExceptionInspection */
	    $it = $stack->getIterator();

    	static::assertFalse($it->valid());
		static::expectException(StackEmptyException::class);

		$it->current();
    }
}
