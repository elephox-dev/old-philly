<?php

declare(strict_types=1);

namespace Philly\Contracts\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

/**
 * Interface ExceptionHandler.
 */
interface ExceptionHandler
{
    /**
     * @param Throwable $throwable
     * @return JsonResponse
     */
    public function handle(Throwable $throwable): JsonResponse;
}
