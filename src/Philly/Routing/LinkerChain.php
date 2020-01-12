<?php
declare(strict_types=1);

namespace Philly\Routing;

use Philly\Container\Container;
use Philly\Contracts\Routing\Linker;
use Philly\Contracts\Routing\LinkerChain as BaseLinkerChain;

/**
 * Class LinkerChain
 */
class LinkerChain extends Container implements BaseLinkerChain
{
    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof Linker;
    }
}
