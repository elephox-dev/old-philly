<?php

declare(strict_types=1);

namespace Philly\Exceptions;

use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Throwable;

/**
 * Class ExceptionHandler.
 */
class ExceptionHandler implements ExceptionHandlerContract
{
    /**
     * @inheritDoc
     */
    public function handle(Throwable $throwable): void
    {
        // TODO: this

        /** @noinspection PhpUnhandledExceptionInspection */
        throw $throwable;
    }
}
