<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgument as CommandArgumentContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;

/**
 * Class CommandArgument.
 */
class CommandArgument extends CommandArgumentTemplate implements CommandArgumentContract
{
    /** @var mixed|null $value The value for this command argument. */
    protected $value;

    /**
     * CommandArgument constructor.
     *
     * @param CommandArgumentTemplateContract $template The template which this command argument is based on.
     * @param mixed|null $value The value of this argument.
     */
    public function __construct(CommandArgumentTemplateContract $template, $value = null)
    {
        parent::__construct($template->getName(), $template->getShortName(),
                            $template->isOptional(), $template->getDefaultValue());

        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->value;
    }
}
