<?php

declare(strict_types=1);

namespace test\Philly;

use Exception;
use Philly\CLI\Commands\Command;
use Philly\CLI\Commands\CommandArgumentTemplate;
use Philly\CLI\Commands\CommandResult;
use Philly\CLI\Commands\CommandSignature;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;
use Philly\Contracts\CLI\Commands\CommandResult as CommandResultContract;
use Philly\Contracts\CLI\Commands\CommandSignature as CommandSignatureContract;

class TestCommand extends Command
{
    public static function makeSignature(): CommandSignatureContract
    {
        return new CommandSignature(
            "test",
            [
                new CommandArgumentTemplate("fail"),
                new CommandArgumentTemplate("val")
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function handle(CommandArgumentCollectionContract $args): CommandResultContract
    {
        if ($args->getValue('fail')) {
            return CommandResult::fail(new Exception("test command failed"), $args->getValue('val'));
        }

        return CommandResult::success($args->getValue('val'));
    }
}
