<?php

declare(strict_types=1);

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

use Dotenv\Dotenv;
use Philly\App;
use Philly\Contracts\Filesystem\FilesService;
use ricardoboss\Console;

$cwd = getcwd();

// load .env file
$dotenv = Dotenv::createImmutable($cwd);
$dotenv->safeLoad();

// configure console for logging
Console::logLevel(intval($_ENV['LOG_LEVEL'] ?? 1));
Console::open();
Console::debug("Bootstrapping application...");

// instantiate App container
$app = App::inst();

// store current dir as app root
$app[FilesService::class]->add('app-root', $cwd);

Console::debug("Bootstrapped application");
