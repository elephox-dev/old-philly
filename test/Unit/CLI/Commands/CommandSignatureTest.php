<?php

declare(strict_types=1);

namespace CLI\Commands;

use Philly\CLI\Commands\CommandArgumentTemplateCollection;
use Philly\CLI\Commands\CommandSignature;
use PHPUnit\Framework\TestCase;

/**
 * Class CommandSignatureTest.
 */
class CommandSignatureTest extends TestCase
{
    public function testSimpleSignature()
    {
        $catc = new CommandArgumentTemplateCollection();
        $s = new CommandSignature("test", $catc);

        static::assertEquals("test", $s->getName());
        static::assertEmpty($s->getAliases());
        static::assertEmpty($s->getArguments());
    }

    public function testAliases()
    {
        $catc = new CommandArgumentTemplateCollection();

        $s1 = new CommandSignature("test1", $catc, ['1']);

        static::assertCount(1, $s1->getAliases());
        static::assertEquals('1', $s1->getAliases()[0]);
    }
}
