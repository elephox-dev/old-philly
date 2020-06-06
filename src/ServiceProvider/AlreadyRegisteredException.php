<?php

declare(strict_types=1);

namespace Philly\ServiceProvider;

use Philly\Contracts\ServiceProvider\ServiceProvider as ServiceProviderContract;
use RuntimeException;
use Throwable;

/**
 * Class AlreadyRegisteredException.
 */
class AlreadyRegisteredException extends RuntimeException
{
    /**
     * AlreadyRegisteredException constructor.
     *
     * @param string|ServiceProviderContract $serviceProvider The message or the contract which was already registered.
     */
    public function __construct($serviceProvider, int $code = 0, Throwable $previous = null)
    {
        if ($serviceProvider instanceof ServiceProviderContract) {
            $name = get_class($serviceProvider);

            $message = "Service provider \"{$name}\" was already registered!";
        } else {
            $message = $serviceProvider;
        }

        parent::__construct($message, $code, $previous);
    }
}
