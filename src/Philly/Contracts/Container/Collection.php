<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;


/**
 * Interface Collection.
 */
interface Collection extends Container
{
    /**
     * @param mixed $value
     * @return Collection
     */
    public function add($value): self;

    /**
     * @param callable $callback
     * @return Collection
     */
    public function where(callable $callback): self;

    /**
     * @param callable $callback
     * @return mixed
     */
    public function first(callable $callback);
}
