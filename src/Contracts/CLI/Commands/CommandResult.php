<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;

use Throwable;

/**
 * Interface CommandResult.
 */
interface CommandResult
{
    /**
     * @return bool Whether or not the command execution was successful.
     */
    public function isSuccess(): bool;

    /**
     * @return mixed|null The result of the command.
     */
    public function getValue();

    /**
     * @return Throwable|null If this command was not successful, then this method returns the exception thrown, if any.
     */
    public function getThrowable(): ?Throwable;
}
