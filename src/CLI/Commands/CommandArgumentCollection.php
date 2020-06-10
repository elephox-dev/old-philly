<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Container\Collection;
use Philly\Contracts\CLI\Commands\CommandArgument as CommandArgumentContract;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;

class CommandArgumentCollection extends Collection implements
    CommandArgumentCollectionContract
{
    public function accepts($value): bool
    {
        return $value instanceof CommandArgumentContract;
    }
}
