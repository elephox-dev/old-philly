<?php
declare(strict_types=1);

namespace Philly\Contracts\Queue;


use IteratorAggregate;
use Philly\Contracts\Support\Storage;
use Traversable;

/**
 * Interface Queue.
 */
interface Queue extends Traversable, IteratorAggregate, Storage
{
	/**
	 * Enqueue a new value into the queue.
	 *
	 * @param mixed|mixed[] $value The value to enqueue.
	 */
	function enqueue(...$value): void;

	/**
	 * Dequeue the first value in the queue. This removed the value form the queue.
	 *
	 * @return mixed The head of the queue.
	 */
	function dequeue();

	/**
	 * @return mixed The head of the queue without removing it from the queue.
	 */
	function head();

	/**
	 * @return mixed The last element of the queue.
	 */
	function tail();

	/**
	 * @inheritDoc
	 */
	function getIterator(): QueueIterator;
}
