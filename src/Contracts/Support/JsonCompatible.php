<?php

declare(strict_types=1);

namespace Philly\Contracts\Support;

use JsonSerializable;

/**
 * Interface JsonCompatible
 */
interface JsonCompatible extends JsonSerializable
{
    /**
     * @return string Returns this object in its JSON representation. This is the result of passing this object to
     * `json_encode` with the options returned from `jsonOptions`.
     */
    public function asJson(): string;

    /**
     * @return int The JSON_* options to be passed to json_encode to serialize this object in JSON.
     */
    public function jsonOptions(): int;
}
