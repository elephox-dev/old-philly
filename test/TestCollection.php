<?php

declare(strict_types=1);

namespace test\Philly;

use Philly\Container\Collection;

/**
 * Class TestCollection
 */
class TestCollection extends Collection
{
    public function getNextOffset(): int
    {
        return parent::getNextOffset();
    }
}
