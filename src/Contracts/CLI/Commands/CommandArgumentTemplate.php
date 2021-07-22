<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;

/**
 * Interface CommandArgumentTemplate.
 */
interface CommandArgumentTemplate
{
    /**
     * @return bool Whether this argument is optional. Requires that CommandArgument::getDefaultValue() returns a
     * non-null value.
     */
    public function isOptional(): bool;

    /**
     * @return bool|int|float|string|null If this argument is optional, then this method returns the default value.
     */
    public function getDefaultValue(): bool|int|float|string|null;

    /**
     * @return string The data type of this argument. Can only be a scalar type (bool|int|float|string|null).
     */
    public function getType(): string;

    /**
     * @return string The short name for this argument (e.g. "v" or "ver").
     */
    public function getShortName(): string;

    /**
     * @return string The human-readable name for this argument (e.g. "version" or "verbosity").
     */
    public function getName(): string;
}
