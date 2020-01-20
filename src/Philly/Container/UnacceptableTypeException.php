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
     * @param $type
     */
    public function __construct($type)
    {
        parent::__construct("Cannot accept objects of type '$type'");
    }
}
