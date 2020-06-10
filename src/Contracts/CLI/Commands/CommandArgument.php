<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;


/**
 * Interface CommandArgument.
 */
interface CommandArgument extends CommandArgumentTemplate
{
    /**
     * @return mixed|null When used to invoke a command, this function returns the value held by this argument.
     * @throws BadMethodCallException If this argument was used to define a command signature and has no value.
     */
    public function getValue();
}
