<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;

/**
 * Class CommandArgumentTemplate.
 */
class CommandArgumentTemplate implements CommandArgumentTemplateContract
{
    /** @var bool $optional Whether this argument is optional. */
    protected bool $optional;

    /** @var mixed|null $default The default value of this command argument. */
    protected $default;

    /** @var string $name The name of this command argument. */
    protected string $name;

    /** @var string $shortName The short name of this command argument. */
    protected string $shortName;

    /**
     * CommandArgumentTemplate constructor.
     *
     * @param string $name A descriptive name for this argument.
     * @param string|null $shortName The short name of this argument.
     * @param bool $optional Whether this argument is optional
     * @param mixed|null $default The default value, if optional.
     */
    public function __construct(string $name, ?string $shortName = null, bool $optional = false, $default = null)
    {
        $this->name = $name;
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
    public function getDefaultValue()
    {
        return $this->default;
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
