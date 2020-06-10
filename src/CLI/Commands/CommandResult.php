<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;


use Philly\Contracts\CLI\Commands\CommandResult as CommandResultContract;
use Throwable;

/**
 * Class CommandResult.
 */
class CommandResult implements CommandResultContract
{
    /**
     * @param mixed|null $value The value passed to the result.
     * @return CommandResultContract
     */
    public static function success($value = null): CommandResultContract
    {
        return new self(true, $value);
    }

    /**
     * @param Throwable|null $throwable The exception thrown in the command.
     * @param mixed|null $value A value to attach to the result.
     * @return CommandResultContract
     */
    public static function fail(?Throwable $throwable = null, $value = null): CommandResultContract
    {
        return new self(false, $value, $throwable);
    }

    /** @var bool Whether the command was successfully executed. */
    protected bool $success;

    /** @var mixed|null The resulting value of the command. */
    protected $value;

    /** @var Throwable|null The exception thrown by a command. */
    protected ?Throwable $throwable;

    public function __construct(bool $success, $value = null, ?Throwable $throwable = null)
    {
        $this->success = $success;
        $this->value = $value;
        $this->throwable = $throwable;
    }

    /**
     * @inheritDoc
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function getThrowable(): ?Throwable
    {
        return $this->throwable;
    }
}
