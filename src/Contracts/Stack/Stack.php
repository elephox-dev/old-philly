<?php
declare(strict_types=1);

namespace Philly\Contracts\Stack;


use IteratorAggregate;
use Philly\Contracts\Support\Storage;
use Philly\Stack\StackEmptyException;
use Traversable;

/**
 * Interface Stack.
 */
interface Stack extends Traversable, IteratorAggregate, Storage
{
	/**
	 * @param mixed|mixed[] $value The value(s) to push onto the stack. The first parameter gets pushed first, then the
	 * second one and so on...
	 */
	function push(...$value): void;

	/**
	 * @return mixed The value on top of the stack. This value also removes the value from the stack.
	 *
	 * @throws StackEmptyException If the stack is empty.
	 */
	function pop();

	/**
	 * @return mixed The value on top of the stack without removing it.
	 *
	 * @throws StackEmptyException If the stack is empty.
	 */
	function peek();

	/**
	 * @inheritDoc
	 */
	function getIterator(): StackIterator;
}
