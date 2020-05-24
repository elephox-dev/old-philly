<?php
declare(strict_types=1);

namespace test\Philly;


use Philly\Container\Container;
use Philly\Container\FiltersTypes;

/**
 * Class TestContainer.
 */
class TestContainer extends Container
{
	use FiltersTypes;

    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof TestInterface;
    }
}
