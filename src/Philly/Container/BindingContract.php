<?php
declare(strict_types=1);

namespace Philly\Container;

use Philly\Contracts\Container\BindingContract as BaseBindingContract;

/**
 * Class BindingContract
 */
class BindingContract extends Container implements BaseBindingContract
{
    /**
     * BindingContract constructor.
     */
    public function __construct(string $interface, callable $builder, bool $singleton)
    {
        $this["interface"] = $interface;
        $this["builder"] = $builder;
        $this["singleton"] = $singleton;
    }

    /**
     * @inheritDoc
     */
    function getInterface(): string
    {
        return $this["interface"];
    }

    /**
     * @inheritDoc
     */
    function getBuilder(): callable
    {
        return $this["builder"];
    }

    /**
     * @inheritDoc
     */
    function makeSingleton(): BaseBindingContract
    {
        $this["singleton"] = true;

        return $this;
    }

    /**
     * @inheritDoc
     */
    function isSingleton(): bool
    {
        return $this["singleton"];
    }
}
