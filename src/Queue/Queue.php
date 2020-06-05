<?php
declare(strict_types=1);

namespace Philly\Queue;


use Philly\Contracts\Queue\Queue as QueueContract;
use Philly\Contracts\Queue\QueueIterator as QueueIteratorContract;
use Philly\Support\Storage;

/**
 * Class Queue.
 */
class Queue extends Storage implements QueueContract
{
	/**
	 * Queue constructor.
	 */
	public function __construct(array $items = [])
	{
		parent::__construct($items);
	}

	/**
	 * @inheritDoc
	 */
	public function getIterator(): QueueIteratorContract
	{
		return new QueueIterator($this);
	}

	/**
	 * @inheritDoc
	 */
	function enqueue(...$value): void
	{
		array_push($this->storage, ...$value);
	}

	/**
	 * @inheritDoc
	 */
	function dequeue()
	{
		$value = array_shift($this->storage);
		if ($value === null)
			throw new QueueEmptyException();

		return $value;
	}

	/**
	 * @inheritDoc
	 */
	function head()
	{
		$value = reset($this->storage);
		if ($value === false)
			throw new QueueEmptyException();

		return $value;
	}

	/**
	 * @inheritDoc
	 */
	function tail()
	{
		$value = end($this->storage);
		if ($value === false)
			throw new QueueEmptyException();

		return $value;
	}
}
