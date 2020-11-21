<?php

declare(strict_types=1);

namespace test\Philly\Unit\Foundation\CLI\Commands;

use Philly\CLI\Commands\CommandArgumentCollection;
use Philly\Foundation\CLI\Commands\VersionCommand;
use PHPUnit\Framework\TestCase;

class VersionCommandTest extends TestCase
{
    public function testConstruct()
    {
        $cmd = new VersionCommand();

        static::assertEquals("version", $cmd->getSignature()->getName());
    }

    public function testHandle()
    {
        $cmd = new VersionCommand();
        $r = $cmd->handle(new CommandArgumentCollection());

        static::assertTrue($r->isSuccess());
        static::assertIsString($r->getValue());
        static::assertNull($r->getThrowable());
    }
}
