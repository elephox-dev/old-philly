<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgument as CommandArgumentContract;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplateCollection as CommandArgumentTemplateCollectionContract;
use Philly\Support\Cloneable;

class CommandArgumentCollection extends CommandArgumentTemplateCollection implements CommandArgumentCollectionContract
{
    use Cloneable;

    public static function fromArray(CommandArgumentTemplateCollectionContract $argumentTemplateCollection, array $args = []): CommandArgumentCollectionContract
    {
        $collection = new CommandArgumentCollection();

        foreach ($args as $k => $v) {
            $template = $argumentTemplateCollection->firstKey($k);
            if ($template == false)
                continue;

            $arg = new CommandArgument($template, $v);
            $collection->add($arg);
        }

        return $collection;
    }

    public function accepts($value): bool
    {
        return $value instanceof CommandArgumentContract;
    }

    public function getValue($key)
    {
        /** @var CommandArgumentContract $arg */
        $arg = parent::firstKey($key, null);

        if ($arg === null)
            return $arg->getDefaultValue();

        return $arg->getValue();
    }
}
