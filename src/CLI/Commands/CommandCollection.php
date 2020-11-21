<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Container\Collection;
use Philly\Contracts\CLI\Commands\Command as CommandContract;
use Philly\Contracts\CLI\Commands\CommandCollection as CommandCollectionContract;

/**
 * Class CommandCollection.
 */
class CommandCollection extends Collection implements CommandCollectionContract
{
    public function accepts($value): bool
    {
        return $value instanceof CommandContract;
    }
}
