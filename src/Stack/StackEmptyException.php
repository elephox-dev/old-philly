<?php

declare(strict_types=1);

namespace Philly\Stack;

use OutOfBoundsException;
use Throwable;

/**
 * Class StackEmptyException.
 */
class StackEmptyException extends OutOfBoundsException
{
    /**
     * StackEmptyException constructor.
     *
     * @param string $message
     * @param int|mixed $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
