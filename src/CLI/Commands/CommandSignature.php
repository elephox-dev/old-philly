<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplateCollection as CommandArgumentTemplateCollectionContract;
use Philly\Contracts\CLI\Commands\CommandSignature as CommandSignatureContract;

/**
 * Class CommandSignature.
 */
class CommandSignature implements CommandSignatureContract
{
    /** @var string The name of this command. */
    protected string $name;

    /** @var string[] The aliases of this command. */
    protected array $aliases;

    /** @var CommandArgumentTemplateCollectionContract The arguments which can be passed to this command. */
    protected CommandArgumentTemplateCollectionContract $arguments;

    /**
     * CommandSignature constructor.
     *
     * @param string $name The name of this command.
     * @param CommandArgumentTemplateCollectionContract|CommandArgumentTemplateContract[] $arguments The arguments of this command.
     * @param string[] $aliases The aliases for this command.
     */
    public function __construct(string $name, $arguments = [], array $aliases = [])
    {
        $this->name = $name;
        if ($arguments instanceof CommandArgumentTemplateCollectionContract) {
            $this->arguments = $arguments;
        } else {
            $this->arguments = new CommandArgumentTemplateCollection($arguments);
        }
        $this->aliases = $aliases;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @inheritDoc
     */
    public function getArguments(): CommandArgumentTemplateCollectionContract
    {
        return $this->arguments;
    }
}
