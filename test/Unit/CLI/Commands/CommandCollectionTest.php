<?php

declare(strict_types=1);

namespace test\Philly\Unit\CLI\Commands;

use Philly\CLI\Commands\CommandCollection;
use Philly\Container\UnacceptableTypeException;
use PHPUnit\Framework\TestCase;

class CommandCollectionTest extends TestCase
{
    public function testAccept()
    {
        $collection = new CommandCollection();

        static::expectException(UnacceptableTypeException::class);

        $collection->add("test");
    }
}
