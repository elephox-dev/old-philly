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
     * @return Collection
     */
    public function where(callable $callback, bool $preserve_keys = true): self;

    /**
     * @return mixed|null
     */
    public function first(callable $callback);

	/**
	 * @inheritDoc
	 */
    public function count(): int;

	/**
	 * @return array Returns a copy of the underlying storage for this collection.
	 */
    public function asArray(): array;
}
