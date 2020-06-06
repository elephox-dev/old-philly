<?php

declare(strict_types=1);

namespace Philly\Contracts\Container;

use Closure;

/**
 * Interface BindingContract
 */
interface BindingContract
{
    /**
     * Get the fully-qualified name of the interface which this contract binds.
     */
    public function getInterface(): string;

    /**
     * Get the builder for this contract.
     */
    public function getBuilder(): Closure;

    /**
     * Turn a binding contract into a singleton contract.
     */
    public function makeSingleton(): self;

    /**
     * Whether or not this binding is a singleton.
     */
    public function isSingleton(): bool;
}
