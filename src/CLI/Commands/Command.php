<?php

declare(strict_types=1);

namespace Philly\CLI\Commands;

use Philly\Contracts\CLI\Commands\Command as CommandContract;
use Philly\Contracts\CLI\Commands\CommandSignature as CommandSignatureContract;

/**
 * Class Command.
 */
abstract class Command implements CommandContract
{
    protected CommandSignatureContract $signature;

    /**
     * Command constructor.
     */
    public function __construct(CommandSignatureContract $signature)
    {
        $this->signature = $signature;
    }

    /**
     * @inheritDoc
     */
    public function getSignature(): CommandSignatureContract
    {
        return $this->signature;
    }
}
