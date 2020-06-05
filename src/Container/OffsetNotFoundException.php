<?php
declare(strict_types=1);

namespace Philly\Container;


use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class OffsetNotFoundException.
 */
class OffsetNotFoundException extends InvalidArgumentException implements ContainerExceptionInterface
{
    /**
     * OffsetNotFoundException constructor.
     * @param mixed $offset
     */
    public function __construct($offset)
    {
        parent::__construct("Offset '$offset' does not exist!");
    }
}
