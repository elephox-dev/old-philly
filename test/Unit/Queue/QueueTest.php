<?php

declare(strict_types=1);

namespace test\Philly\Unit\Queue;

use Philly\Queue\Queue;
use Philly\Queue\QueueEmptyException;
use PHPUnit\Framework\TestCase;
use test\Philly\SecondTestClass;
use test\Philly\TestClass;

/**
 * Class QueueTest.
 */
class QueueTest extends TestCase
{
    public function testHead()
    {
        $queue = new Queue();

        $instance = new TestClass();
        $queue->enqueue($instance);

        $result = $queue->head();
        static::assertSame($instance, $result);
    }

    public function testDequeue()
    {
        $queue = new Queue();

        $instance = new TestClass();
        $queue->enqueue($instance);

        $result = $queue->dequeue();
        static::assertSame($instance, $result);

        static::expectException(QueueEmptyException::class);
        $queue->dequeue();
    }

    public function testTail()
    {
        $queue = new Queue();

        $instance_a = new TestClass();
        $instance_b = new SecondTestClass();

        $queue->enqueue($instance_a, $instance_b);

        $result = $queue->tail();

        static::assertSame($instance_b, $result);

        $queue->dequeue();
        $queue->dequeue();

        static::expectException(QueueEmptyException::class);
        $queue->tail();
    }
}
