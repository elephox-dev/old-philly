#!/usr/bin/env php
<?php

declare(strict_types=1);

if (PHP_SAPI != 'cli') {
    echo PHP_EOL . 'PhillyCLI may only be invoked from a command line, got "' . PHP_SAPI . '"' . PHP_EOL;

    exit(1);
}

$autoload = "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
for ($i = 0; $i < 10 && realpath($autoload) === false; $i++) {
    $autoload = ".." . DIRECTORY_SEPARATOR . $autoload;
}

if (realpath($autoload) === false) {
    echo PHP_EOL . 'Could not find autoload.php' . PHP_EOL;

    exit(1);
}

/** @noinspection PhpIncludeInspection */
require $autoload;

/******************************************************************************/

use Philly\App;
use Philly\CLI\Commands\CommandArgument;
use Philly\CLI\Commands\CommandArgumentCollection;
use Philly\Contracts\CLI\Commands\Command as CommandContract;
use Philly\Queue\Queue;

$app = App::inst();
$commands = $app->getCommands();

$args = new Queue($argv);

// remove path to bin
$args->dequeue();

if ($args->isEmpty()) {
    echo 'To see a list of available commands, please run the "list" command' . PHP_EOL;

    exit(1);
}

// get first argument
$commandString = $args->dequeue();

/** @var CommandContract $command */
$command = $commands->first(function (CommandContract $command) use ($commandString) {
    return $commandString === $command->getSignature()->getName();
});

if ($command === null) {
    echo 'Unknown command: ' . $commandString . PHP_EOL;

    exit(1);
}

$templates = $command->getSignature()->getArguments();
$arguments = new CommandArgumentCollection();
foreach ($args as $arg) {
    $argument = new CommandArgument($templates->get($i), $arg);

    $arguments->add($argument);
}

$result = $command->handle($arguments);

if (!$result->isSuccess()) {
    echo 'Command was not successful.' . PHP_EOL;

    if (($throwable = $result->getThrowable()) !== null) {
        echo $throwable->getMessage() . PHP_EOL;
        echo $throwable->getTraceAsString() . PHP_EOL;
    }

    exit(1);
}

if (($value = $result->getValue()) !== null) {
    print_r($value);
}

exit(0);
