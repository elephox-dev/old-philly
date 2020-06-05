<?php
declare(strict_types=1);

namespace Philly\Contracts\Support;


use Countable;

/**
 * Interface Storage.
 */
interface Storage extends Countable, JsonCompatible
{
	/**
	 * @return bool Whether this storage is empty.
	 */
	function isEmpty(): bool;

	/**
	 * @inheritDoc
	 */
	function count(): int;

	/**
	 * Clears the storage.
	 */
	function clear(): void;
}
