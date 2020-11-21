<?php

declare(strict_types=1);

namespace Philly\Foundation\CLI\Commands;

use Philly\App;
use Philly\CLI\Commands\Command;
use Philly\CLI\Commands\CommandResult;
use Philly\CLI\Commands\CommandSignature;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;
use Philly\Contracts\CLI\Commands\CommandResult as CommandResultContract;

/**
 * Class VersionCommand.
 */
class VersionCommand extends Command
{
    public function __construct()
    {
        parent::__construct(new CommandSignature("version"));
    }

    public function handle(CommandArgumentCollectionContract $args): CommandResultContract
    {
        return CommandResult::success(App::VERSION);
    }
}
