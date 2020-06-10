<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;


use BadMethodCallException;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;

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

    public function __construct(string $name, ?string $shortName = null, $default = null, bool $optional = false)
    {
        $this->name = $name;
        if ($shortName === null)
            $this->shortName = substr($name, 0, 1);

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
        if (!$this->isOptional())
            throw new BadMethodCallException("This argument is not optional and therefore has not default value.");

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
