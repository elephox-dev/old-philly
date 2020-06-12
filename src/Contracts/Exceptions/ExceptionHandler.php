<?php

declare(strict_types=1);

namespace Philly\Contracts\Exceptions;

use Throwable;

/**
 * Interface ExceptionHandler.
 */
interface ExceptionHandler
{
    /**
     * @param Throwable $throwable
     */
    public function handle(Throwable $throwable): void;
}
