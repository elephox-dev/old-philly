<?php

declare(strict_types=1);

namespace test\Philly\Unit\Exceptions;

use InvalidArgumentException;
use Philly\Exceptions\ExceptionHandler;
use PHPUnit\Framework\TestCase;

/**
 * Class ExceptionHandlerTest
 */
class ExceptionHandlerTest extends TestCase
{
    public function testHandle()
    {
        $handler = new ExceptionHandler();
        $exception = new InvalidArgumentException("test");

        // TODO: implement test for behaviour
        static::expectException(InvalidArgumentException::class);

        $handler->handle($exception);
    }
}
