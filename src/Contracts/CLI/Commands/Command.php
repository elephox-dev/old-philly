<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;

/**
 * Interface Command.
 */
interface Command
{
    /**
     * @return CommandSignature The signature of this command.
     */
    public function getSignature(): CommandSignature;

    /**
     * Handle a given set of arguments.
     *
     * @param CommandArgumentCollection $args The arguments passed to the command.
     * @return CommandResult The result of this command.
     */
    public function handle(CommandArgumentCollection $args): CommandResult;
}
