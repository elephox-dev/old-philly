<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgument as CommandArgumentContract;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplateCollection as CommandArgumentTemplateCollectionContract;

class CommandArgumentCollection extends CommandArgumentTemplateCollection implements CommandArgumentCollectionContract
{
    public static function fromArray(CommandArgumentTemplateCollectionContract $argumentTemplateCollection, array $args = []): CommandArgumentCollectionContract
    {
        $collection = new CommandArgumentCollection();

        foreach ($args as $k => $v) {
            $template = $argumentTemplateCollection->firstKey($k);
            if ($template == false) {
                continue;
            }

            $arg = new CommandArgument($template, $v);
            $collection->add($arg);
        }

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof CommandArgumentContract;
    }

    /**
     * @inheritDoc
     */
    public function getValue(string $key, $default = null)
    {
        /** @var CommandArgumentContract $arg */
        $arg = parent::firstKey($key, null);

        if ($arg === null) {
            return $default;
        }

        return $arg->getValue();
    }
}
