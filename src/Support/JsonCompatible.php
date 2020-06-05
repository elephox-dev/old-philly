<?php
declare(strict_types=1);

namespace Philly\Support;


/**
 * Trait JsonCompatible.
 *
 * @mixin \Philly\Contracts\Support\JsonCompatible
 */
trait JsonCompatible
{
	/**
	 * @return string Returns this object in its JSON representation. This is the result of passing this object to
	 * `json_encode` with the options returned from `jsonOptions`.
	 */
	public function asJson(): string
	{
		return json_encode($this->jsonSerialize(), $this->jsonOptions());
	}

	/**
	 * @return int The JSON_* options to be passed to json_encode to serialize this object in JSON.
	 */
	public function jsonOptions(): int
	{
		return JSON_THROW_ON_ERROR;
	}
}
