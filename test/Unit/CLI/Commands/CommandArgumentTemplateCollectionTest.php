<?php

declare(strict_types=1);

namespace test\Philly\Unit\CLI\Commands;

use Philly\CLI\Commands\CommandArgumentTemplate;
use Philly\CLI\Commands\CommandArgumentTemplateCollection;
use Philly\Container\UnacceptableTypeException;
use PHPUnit\Framework\TestCase;

class CommandArgumentTemplateCollectionTest extends TestCase
{
    public function testConstruct()
    {
        $template = new CommandArgumentTemplate("test");
        $collection = new CommandArgumentTemplateCollection([$template]);

        static::assertCount(1, $collection);

        static::expectException(UnacceptableTypeException::class);
        $collection->add("test");
    }

    public function testFirstKey()
    {
        $template = new CommandArgumentTemplate("test");
        $collection = new CommandArgumentTemplateCollection([$template]);

        static::assertSame($template, $collection->firstKey('test'));
        static::assertSame($template, $collection->firstKey('t'));
    }
}
