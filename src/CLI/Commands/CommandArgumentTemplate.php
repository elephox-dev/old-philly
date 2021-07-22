<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;
use TypeError;

/**
 * Class CommandArgumentTemplate.
 */
class CommandArgumentTemplate implements CommandArgumentTemplateContract
{
    /** @var bool $optional Whether this argument is optional. */
    protected bool $optional;

    /** @var scalar|null $default The default value of this command argument. */
    protected string|int|bool|null|float $default;

    /** @var string $type The type of this argument. */
    protected string $type;

    /** @var string $name The name of this command argument. */
    protected string $name;

    /** @var string $shortName The short name of this command argument. */
    protected string $shortName;

    /**
     * CommandArgumentTemplate constructor.
     *
     * @param string $name A descriptive name for this argument.
     * @param string $type The expected type of this argument.
     * @param string|null $shortName The short name of this argument.
     * @param bool $optional Whether this argument is optional
     * @param bool|int|float|string|null $default The default value, if optional.
     */
    public function __construct(string $name, string $type, ?string $shortName = null, bool $optional = false, bool|int|float|string $default = null)
    {
        if (!in_array($type, ['bool', 'int', 'float', 'string', 'null'])) {
            throw new TypeError("Invalid argument type: $type. Must be a scalar type (bool|int|float|string|null).");
        }

        $this->name = $name;
        $this->type = $type;
        $this->shortName = $shortName ?? substr($name, 0, 1);

        $this->default = $default;
        $this->optional = $optional;
    }

    /**
     * @inheritDoc
     */
    public function isOptional(): bool
    {
        return $this->optional;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultValue(): bool|int|float|string|null
    {
        return $this->default;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }
}
