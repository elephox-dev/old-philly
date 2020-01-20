<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;


use Countable;

/**
 * Interface Collection.
 */
interface Collection extends Container, Countable
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
    public function where(callable $callback, bool $preserve_keys = true): self;

    /**
     * @param callable $callback
     * @return mixed
     */
    public function first(callable $callback);

    /**
     * @return int
     */
    public function count(): int;
}
