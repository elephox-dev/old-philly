<?php

declare(strict_types=1);

namespace test\Philly;

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
                new CommandArgumentTemplate("fail", "f")
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function handle(CommandArgumentCollectionContract $args): CommandResultContract
    {
        if ($args['fail']) {
            return CommandResult::fail();
        }

        return CommandResult::success();
    }
}
