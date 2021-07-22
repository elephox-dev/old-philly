<?php

declare(strict_types=1);

namespace test\Philly\Unit\CLI\Commands;

use Philly\CLI\Commands\CommandArgumentTemplate;
use PHPUnit\Framework\TestCase;

class CommandArgumentTemplateTest extends TestCase
{
    public function testConstruct()
    {
        $template = new CommandArgumentTemplate('test', "string", 'te');

        static::assertEquals('test', $template->getName());
        static::assertEquals('te', $template->getShortName());
        static::assertNull($template->getDefaultValue());
        static::assertFalse($template->isOptional());
    }
}
