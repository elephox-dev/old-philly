<?php

declare(strict_types=1);

namespace Philly\Foundation\CLI\Commands;

use Philly\App;
use Philly\CLI\Commands\Command;
use Philly\CLI\Commands\CommandResult;
use Philly\CLI\Commands\CommandSignature;
use Philly\Contracts\CLI\Commands\Command as CommandContract;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplateCollection as CommandArgumentTemplateCollectionContract;
use Philly\Contracts\CLI\Commands\CommandResult as CommandResultContract;
use ricardoboss\Console;

/**
 * Class ListCommand.
 */
class ListCommand extends Command
{
    public function __construct()
    {
        parent::__construct(new CommandSignature("list"));
    }

    public function handle(CommandArgumentCollectionContract $args): CommandResultContract
    {
        /** @var CommandContract[] $commands */
        $commands = App::inst()->getCommands()->getValues();

        Console::info("Available commands:");
        Console::info("%s\t\t\t%s", Console::reverse(Console::green("Name")), Console::reverse(Console::yellow("Arguments")));

        usort($commands, fn (CommandContract $a, CommandContract $b) => strcmp($a->getSignature()->getName(), $b->getSignature()->getName()));
        foreach ($commands as $command) {
            $signature = $command->getSignature();
            /** @var CommandArgumentTemplateCollectionContract|CommandArgumentTemplateContract[] $args */
            $args = $signature->getArguments();
            $argstrs = [];
            foreach ($args as $argument) {
                $argstr = "";
                $type = $argument->getType();
                $typeDisplay = Console::bold(Console::blue($type));
                $nameDisplay = Console::bold(Console::yellow($argument->getName()));
                if ($argument->isOptional()) {
                    $default = $argument->getDefaultValue();
                    if ($type === "null" || $default === null) {
                        $defaultValue = "null";
                    } elseif ($type === "string") {
                        $defaultValue = "\"$default\"";
                    } else {
                        $defaultValue = "$default";
                    }
                    $defaultDisplay = Console::cyan($defaultValue);

                    $argstr .= Console::default("[$typeDisplay $nameDisplay=$defaultDisplay]");
                } else {
                    $argstr .= "$typeDisplay $nameDisplay";
                }
                $argstrs[] = $argstr;
            }

            if (empty($argstrs)) {
                $argstrs[] = Console::black("none");
            }

            $name = $signature->getName();
            $tabs = (int) ceil((23 - strlen($name)) / 8);
            $tabsstr = str_repeat("\t", $tabs);
            Console::info("%s$tabsstr%s", Console::green($name), join(", ", $argstrs));
        }

        return CommandResult::success();
    }
}
