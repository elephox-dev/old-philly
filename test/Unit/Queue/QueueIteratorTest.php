<?php
declare(strict_types=1);

namespace test\Philly\Unit\Queue;

use Philly\Queue\Queue;
use Philly\Queue\QueueEmptyException;
use PHPUnit\Framework\TestCase;
use test\Philly\SecondTestClass;
use test\Philly\TestClass;
use test\Philly\TestInterface;

/**
 * Class QueueIteratorTest.
 */
class QueueIteratorTest extends TestCase
{
    public function testIterator()
    {
        $queue = new Queue();
        $queue->enqueue(new TestClass(), new TestClass(), new SecondTestClass());

        /** @noinspection PhpUnhandledExceptionInspection */
        $it = $queue->getIterator();

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
    	$queue = new Queue();

	    /** @noinspection PhpUnhandledExceptionInspection */
	    $it = $queue->getIterator();

    	static::assertFalse($it->valid());
		static::expectException(QueueEmptyException::class);

		$it->current();
    }
}
