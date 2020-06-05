<?php
declare(strict_types=1);

namespace test\Philly;


use Philly\Container\Container;
use Philly\Container\FiltersTypes;
use Philly\Contracts\Container\FiltersTypes as FiltersTypesContract;

/**
 * Class TestContainer.
 */
class TestContainer extends Container implements FiltersTypesContract
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
