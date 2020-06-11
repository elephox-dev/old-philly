<?php

declare(strict_types=1);

namespace test\Philly\Unit\CLI\Commands;

use Philly\CLI\Commands\CommandArgumentTemplate;
use PHPUnit\Framework\TestCase;
use test\Philly\TestCommand;

class CommandTest extends TestCase
{
    public function testSignature()
    {
        $s = TestCommand::makeSignature();

        static::assertEquals("test", $s->getName());
        static::assertCount(0, $s->getAliases());

        $args = $s->getArguments();

        static::assertCount(1, $args);

        /** @var CommandArgumentTemplate $arg */
        $arg = $args->first();

        static::assertInstanceOf(CommandArgumentTemplate::class, $arg);

        static::assertEquals("fail", $arg->getName());
        static::assertEquals("f", $arg->getShortName());
        static::assertNull($arg->getDefaultValue());
        static::assertFalse($arg->isOptional());
    }

    public function testHandle()
    {
    }
}
