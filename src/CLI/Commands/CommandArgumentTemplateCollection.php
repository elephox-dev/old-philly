<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Container\Collection;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplateCollection as CommandArgumentTemplateCollectionContract;

class CommandArgumentTemplateCollection extends Collection implements
    CommandArgumentTemplateCollectionContract
{
    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof CommandArgumentTemplateContract;
    }
}