#!/usr/bin/env php
<?php

declare(strict_types=1);

if (PHP_SAPI != 'cli') {
    echo PHP_EOL . 'PhillyCLI may only be invoked from a command line, got "' . PHP_SAPI . '"' . PHP_EOL;

    exit(1);
}

$autoload = "vendor" . DIRECTORY_SEPARATOR ."autoload.php";
for ($i = 0; $i < 10 && realpath($autoload) === false; $i++)
    $autoload = ".." . DIRECTORY_SEPARATOR . $autoload;

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

$app = App::inst();
$commands = $app->getCommands();

// remove path to bin
array_shift($argv);

// get first argument
$commandString = array_shift($argv);

/** @var CommandContract $command */
$command = $commands->first(function (CommandContract $command) use ($commandString) {
    return $commandString === $command->getSignature()->getName();
});

if ($command === null) {
    echo PHP_EOL . 'Unknown command: ' . $commandString . PHP_EOL;

    exit(1);
}

$templates = $command->getSignature()->getArguments();
$arguments = new CommandArgumentCollection();
for ($i = 0; $i < count($argv); $i++)
{
    $argument = new CommandArgument($templates->get($i), $argv[$i]);

    $arguments->add($argument);
}

$result = $command->handle($arguments);

if (!$result->isSuccess()) {
    echo PHP_EOL . 'Command was not successful.' . PHP_EOL;

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
