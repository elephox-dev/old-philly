<?php
declare(strict_types=1);

namespace Philly\Container;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class UnacceptableKeyException.
 */
class UnacceptableKeyException extends InvalidArgumentException implements ContainerExceptionInterface
{
    /**
     * UnacceptableKeyException constructor.
     */
    public function __construct(string $type)
    {
        parent::__construct("Cannot accept values of '$type' as key.");
    }
}
