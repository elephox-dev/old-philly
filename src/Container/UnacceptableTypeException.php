<?php
declare(strict_types=1);

namespace Philly\Container;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class UnacceptableTypeException
 */
class UnacceptableTypeException extends InvalidArgumentException implements ContainerExceptionInterface
{
    /**
     * UnacceptableTypeException constructor.
     */
    public function __construct(string $type)
    {
        parent::__construct("Cannot accept objects of type '$type'");
    }
}
