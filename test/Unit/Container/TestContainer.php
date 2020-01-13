<?php
declare(strict_types=1);

namespace test\Philly\Unit\Container;


use Philly\Container\Container;

/**
 * Class TestContainer.
 */
class TestContainer extends Container
{
    public function accepts($value): bool
    {
        return $value instanceof TestClass;
    }
}
