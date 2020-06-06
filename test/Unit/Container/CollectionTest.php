<?php

declare(strict_types=1);

namespace test\Philly\Unit\Container;

use Philly\Container\Collection;
use Philly\Container\OffsetNotFoundException;
use PHPUnit\Framework\TestCase;
use test\Philly\TestCollection;

/**
 * Class CollectionTest.
 */
class CollectionTest extends TestCase
{
    public function testOffsetUnset()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);

        static::assertCount(5, $collection);

        $collection->offsetUnset(1);

        try {
            static::expectException(OffsetNotFoundException::class);

            $collection->offsetGet(1);
        } finally {
            static::assertCount(4, $collection);
        }
    }

    public function testAdd()
    {
        $collection = new Collection();

        static::assertCount(0, $collection);

        $collection->add('test');

        static::assertEquals('test', $collection[0]);
        static::assertCount(1, $collection);
    }

    public function testFirst()
    {
        $collection = new Collection([
            'abc',
            'def',
            'ghi',
        ]);

        static::assertEquals('abc', $collection->first());

        static::assertEquals('def', $collection->first(function ($val) {
            return strpos($val, 'e') !== false;
        }));

        static::assertNull($collection->first(function () {
            return false;
        }));

        $empty = new Collection();

        static::assertNull($empty->first());
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

        static::assertCount(3, $b_collection);
        static::assertEquals(['ab', 'bb', 'bc'], $b_collection->getValues());
    }

    public function testWherePreserveKeys()
    {
        $collection = new Collection([
            0 => 'Apple',
            1 => 'Bee',
            2 => 'Citrus',
            3 => 'Delta'
        ]);

        $filter = fn ($val) => strpos($val, 'e') !== false;
        $filteredSameKeys = $collection->where($filter);
        $filteredNewKeys = $collection->where($filter, false);

        static::assertCount(3, $filteredSameKeys);
        static::assertEquals([0, 1, 3], $filteredSameKeys->getKeys());
        static::assertEquals([0, 1, 2], $filteredNewKeys->getKeys());
    }

    public function testOffsetSet()
    {
        $collection = new Collection(['alice', 'bob', 'charlie']);

        $collection->offsetSet(0, 'anton');

        $val = $collection->getValues()[0];
        static::assertEquals('anton', $val);
    }

    public function testNextOffset()
    {
        $collection = new TestCollection();

        static::assertEquals(0, $collection->getNextOffset());

        $collection->add("test");

        static::assertEquals(1, $collection->getNextOffset());

        $collection->offsetSet(3, "far away");

        static::assertEquals(4, $collection->getNextOffset());

        $collection->offsetSet(2, "closer");

        static::assertEquals(4, $collection->getNextOffset());

        $collection->add("next");

        static::assertEquals(5, $collection->getNextOffset());

        $collection->offsetUnset(4);

        static::assertEquals(4, $collection->getNextOffset());

        $collection->offsetUnset(1);

        static::assertEquals(4, $collection->getNextOffset());
    }

    public function testAsArray()
    {
        $collection = new Collection(["test", "moo", "ooo"]);

        $arr = $collection->asArray();

        static::assertEquals(["test", "moo", "ooo"], $arr);
    }

    public function testAny()
    {
        $collection = new Collection(["foo", "bar", "faz", "baz"]);

        static::assertTrue($collection->any());
        static::assertTrue($collection->any(fn ($v) => str_contains($v, "a")));
        static::assertFalse($collection->any(fn ($v) => str_contains($v, "e")));

        $collection->clear();

        static::assertFalse($collection->any());
    }
}
