<?php
declare(strict_types=1);

namespace Philly\Container;


use Exception;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

/**
 * Class OffsetNotFoundException.
 */
class OffsetNotFoundException extends Exception implements ContainerExceptionInterface
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
