<?php

declare(strict_types=1);

namespace test\Philly;

use Philly\App;

class TestApp extends App
{
    public static function reset()
    {
        static::$instance = null;
    }
}
