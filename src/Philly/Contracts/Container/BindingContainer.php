<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;

use Closure;

/**
 * Interface BindingContainer
 */
interface BindingContainer extends Container
{
    /**
     * Bind a builder callback to a contract.
     *
     * @param Closure|mixed $builder Can be a callable or an instance which implements the given interface.
     */
    public function bind(string $interface, $builder, bool $singleton = false): BindingContract;
}
