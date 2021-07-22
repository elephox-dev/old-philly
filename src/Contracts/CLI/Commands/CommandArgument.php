<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;

/**
 * Interface CommandArgument.
 */
interface CommandArgument extends CommandArgumentTemplate
{
    /**
     * @return bool|int|float|string|null When used to invoke a command, this function returns the value held by this argument.
     */
    public function getValue(): bool|int|float|string|null;
}
