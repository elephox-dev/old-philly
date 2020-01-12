<?php
declare(strict_types=1);

namespace Philly\Container;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

/**
 * Class UnacceptableTypeException
 */
class UnacceptableTypeException extends InvalidArgumentException implements ContainerExceptionInterface
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
