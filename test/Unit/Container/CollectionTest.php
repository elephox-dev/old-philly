<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;

use Philly\Container\Collection;
use Philly\Container\OffsetNotFoundException;
use PHPUnit\Framework\TestCase;

/**
 * Class CollectionTest.
 */
class CollectionTest extends TestCase
{
    public function testOffsetUnset()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);

        $this->assertCount(5, $collection);

        $collection->offsetUnset(1);

        try {
            $this->expectException(OffsetNotFoundException::class);

            /** @noinspection PhpUnhandledExceptionInspection */
            $collection->offsetGet(1);
        } finally {
            $this->assertCount(4, $collection);
        }
    }

    public function testAdd()
    {
        $collection = new Collection();

        $this->assertCount(0, $collection);

        $collection->add('test');

        $this->assertEquals('test', $collection[0]);
        $this->assertCount(1, $collection);
    }

    public function testFirst()
    {
        $collection = new Collection([
            'abc',
            'def',
            'ghi',
        ]);

        $first = $collection->first(function ($val) {
            return strpos($val, 'e') !== false;
        });

        $this->assertEquals('def', $first);
    }

    public function testWhere()
    {
        $collection = new Collection([
            'aa',
            'ab',
            'bb',
            'bc',
            'cc',
        ]);

        $b_collection = $collection->where(function ($val) {
            return strpos($val, 'b') !== false;
        });

        $this->assertCount(3, $b_collection);
        $this->assertEquals(['ab', 'bb', 'bc'], $b_collection->getValues());
    }

    public function testOffsetSet()
    {
        $collection = new Collection(['alice', 'bob', 'charlie']);

        $collection->offsetSet(0, 'anton');

        $val = $collection->getValues()[0];
        $this->assertEquals('anton', $val);
    }
}
