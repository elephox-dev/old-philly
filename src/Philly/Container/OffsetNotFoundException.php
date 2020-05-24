<?php
declare(strict_types=1);

namespace Philly\Container;


use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class OffsetNotFoundException.
 */
class OffsetNotFoundException extends Exception implements ContainerExceptionInterface
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
