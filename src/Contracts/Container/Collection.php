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
     */
    function add($value): self;

    /**
     * @param callable $callback
     */
    function where(callable $callback, bool $preserve_keys = true): self;

    /**
     * @return mixed|null
     */
    function first(callable $callback);

	/**
	 * @return array Returns a copy of the underlying storage for this collection.
	 */
    function asArray(): array;
}
