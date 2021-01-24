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

// instantiate App container
Philly\App::inst();
