<?php

declare(strict_types=1);

namespace test\Philly\Unit\CLI\Commands;

use Philly\CLI\Commands\CommandArgumentCollection;
use Philly\CLI\Commands\CommandArgumentTemplate;
use PHPUnit\Framework\TestCase;
use test\Philly\TestClass;
use test\Philly\TestCommand;
use Throwable;

class CommandTest extends TestCase
{
    public function testSignature()
    {
        $s = TestCommand::makeSignature();

        static::assertEquals("test", $s->getName());
        static::assertCount(0, $s->getAliases());

        $args = $s->getArguments();

        static::assertCount(2, $args);

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
        $s = TestCommand::makeSignature();
        $c = new TestCommand($s);

        $val = new TestClass();
        $success_args = CommandArgumentCollection::fromArray(
            $s->getArguments(),
            [
                'fail' => false,
                'val' => $val
            ]
        );
        $r1 = $c->handle($success_args);

        static::assertTrue($r1->isSuccess());
        static::assertNull($r1->getThrowable());
        static::assertSame($val, $r1->getValue());

        $fail_args = CommandArgumentCollection::fromArray(
            $s->getArguments(),
            [
                'fail' => true,
                'val' => $val
            ]
        );
        $r2 = $c->handle($fail_args);

        static::assertFalse($r2->isSuccess());
        static::assertInstanceOf(Throwable::class, $r2->getThrowable());
        static::assertSame($val, $r2->getValue());
    }
}
