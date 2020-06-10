<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;


/**
 * Interface CommandSignature.
 */
interface CommandSignature
{
    /**
     * @return string The name of this command.
     */
    public function getName(): string;

    /**
     * @return string[] An array of aliases for this command.
     */
    public function getAliases(): array;

    /**
     * @return CommandArgumentTemplateCollection The collection of argument templates, which can be passed to this
     * command.
     */
    public function getArguments(): CommandArgumentTemplateCollection;
}
