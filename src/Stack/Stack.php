<?php
declare(strict_types=1);

namespace Philly\Stack;


use Philly\Contracts\Stack\Stack as StackContract;
use Philly\Contracts\Stack\StackIterator as StackIteratorContract;
use Philly\Support\JsonCompatible;

class Stack implements StackContract
{
	use JsonCompatible;

	/** @var mixed[] The storage for this stack implementation. */
	protected array $storage;

	/**
	 * Stack constructor.
	 */
	public function __construct(array $items = [])
	{
		$this->storage = $items;
	}

	/**
	 * @inheritDoc
	 */
	public function getIterator(): StackIteratorContract
	{
		return new StackIterator($this);
	}

	/**
	 * @inheritDoc
	 */
	public function push(...$value): void
	{
		array_push($this->storage, ...$value);
	}

	/**
	 * @inheritDoc
	 */
	public function pop()
	{
		$value = array_pop($this->storage);
		if ($value === null)
			throw new StackEmptyException();

		return $value;
	}

	/**
	 * @inheritDoc
	 */
	public function peek()
	{
		$value = end($this->storage);
		if ($value === false)
			throw new StackEmptyException();

		return $value;
	}

	/**
	 * @inheritDoc
	 */
	public function isEmpty(): bool
	{
		return $this->count() == 0;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize(): array
	{
		return $this->storage;
	}

	/**
	 * @inheritDoc
	 */
	public function count(): int
	{
		return count($this->storage);
	}
}
