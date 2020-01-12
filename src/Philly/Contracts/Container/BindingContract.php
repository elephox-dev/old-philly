<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;

/**
 * Interface BindingContract
 */
interface BindingContract
{
    /**
     * Get the fully-qualified name of the interface which this contract binds.
     */
    function getInterface(): string;

    /**
     * Get the builder for this contract.
     */
    function getBuilder(): callable;

    /**
     * Turn a binding contract into a singleton contract.
     */
    function makeSingleton(): BindingContract;

    /**
     * Whether or not this binding is a singleton.
     */
    function isSingleton(): bool;
}
