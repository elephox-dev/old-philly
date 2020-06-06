<?php

declare(strict_types=1);

namespace Philly\Container;

use Closure;
use Philly\Contracts\Container\BindingContract as BaseBindingContract;

/**
 * Class BindingContract
 */
class BindingContract implements BaseBindingContract
{
    /**
     * The interface which this contract binds.
     */
    protected string $interface;

    /**
     * The builder for the interface bound.
     */
    protected Closure $builder;

    /**
     * Whether this contract is a singleton.
     */
    protected bool $singleton;

    /**
     * BindingContract constructor.
     */
    public function __construct(string $interface, Closure $builder, bool $singleton)
    {
        $this->interface = $interface;
        $this->builder = $builder;
        $this->singleton = $singleton;
    }

    /**
     * @inheritDoc
     */
    public function getInterface(): string
    {
        return $this->interface;
    }

    /**
     * @inheritDoc
     */
    public function getBuilder(): Closure
    {
        return $this->builder;
    }

    /**
     * @inheritDoc
     */
    public function makeSingleton(): BaseBindingContract
    {
        $this->singleton = true;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isSingleton(): bool
    {
        return $this->singleton;
    }
}
