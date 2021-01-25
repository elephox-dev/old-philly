<?php

declare(strict_types=1);

namespace test\Philly\Unit\Foundation\CLI\Commands;

use Philly\CLI\Commands\Command;
use Philly\CLI\Commands\CommandArgumentCollection;
use Philly\Foundation\CLI\Commands\CreateCommandCommand;
use PHPUnit\Framework\TestCase;

class CreateCommandCommandTest extends TestCase
{
    public function testConstruct()
    {
        $cmd = new CreateCommandCommand();

        static::assertEquals("create:command", $cmd->getSignature()->getName());
    }

    public function testHandleRandomName()
    {
        $fileLoc = null;

        try {
            $cmd = new CreateCommandCommand();
            $tmp = sys_get_temp_dir();
            $ns = "App1\\test2\\Commands3";

            /** @noinspection PhpUnhandledExceptionInspection */
            $rand = random_int(0, 99);

            $r = $cmd->handle(
                CommandArgumentCollection::fromArray(
                    $cmd->getSignature()->getArguments(),
                    [
                        'name' => "test$rand",
                        'short' => "t",
                        'args' => "arg1,arg2,arg3",
                        'namespace' => $ns,
                        'dest' => $tmp
                    ]
                )
            );

            static::assertTrue($r->isSuccess());
            static::assertNull($r->getThrowable());
            static::assertIsString($r->getValue());

            /** @var string $fileLoc */
            $fileLoc = $r->getValue();
            static::assertTrue(file_exists($fileLoc));

            /** @noinspection PhpIncludeInspection */
            include $fileLoc;

            $classname = $ns . "\\Test{$rand}Command";
            static::assertTrue(class_exists($classname));

            /** @var Command $c */
            $c = new $classname();
            static::assertInstanceOf(Command::class, $c);

            $genSig = $c->getSignature();
            static::assertEquals("test$rand", $genSig->getName());
        } finally {
            if ($fileLoc !== null && file_exists($fileLoc)) {
                unlink($fileLoc);
            }
        }
    }
}
