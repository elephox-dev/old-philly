<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\CommandArgument as CommandArgumentContract;
use Philly\Contracts\CLI\Commands\CommandArgumentTemplate as CommandArgumentTemplateContract;
use TypeError;

/**
 * Class CommandArgument.
 */
class CommandArgument extends CommandArgumentTemplate implements CommandArgumentContract
{
    protected bool|int|float|string|null $value;

    /**
     * CommandArgument constructor.
     *
     * @param CommandArgumentTemplateContract $template The template which this command argument is based on.
     * @param bool|int|float|string|null $value The value of this argument.
     */
    public function __construct(CommandArgumentTemplateContract $template, bool|int|float|string|null $value = null)
    {
        parent::__construct(
            $template->getName(),
            $template->getType(),
            $template->getShortName(),
            $template->isOptional(),
            $template->getDefaultValue(),
        );

        $actualType = strtolower(gettype($value));
        if (!is_scalar($value)) {
            throw new TypeError("Expected value to be a scalar, got: $actualType");
        }

        $expectedType = $template->getType();
        $checker = "is_" . $expectedType;
        if (!function_exists($checker)) {
            throw new TypeError("Unexpected template type: $expectedType.");
        }

        if ($checker($value)) {
            $actualValue = $value;
        } elseif ($expectedType === "int") {
            $actualValue = intval($value);
        } elseif ($expectedType === "float") {
            $actualValue = floatval($value);
        } elseif ($expectedType === "bool") {
            $actualValue = boolval($value);
        } elseif ($expectedType === "string") {
            $actualValue = (string)$value;
        } else {
            throw new TypeError("Expected value of type $expectedType, got: $actualType");
        }

        $this->value = $actualValue;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): bool|int|float|string|null
    {
        return $this->value;
    }
}
