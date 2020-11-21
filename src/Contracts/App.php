<?php

declare(strict_types=1);

namespace Philly\Contracts;

use Philly\Contracts\CLI\Commands\CommandCollection as CommandCollectionContract;
use Philly\Contracts\Container\BindingContainer;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;

/**
 * Interface App
 */
interface App extends BindingContainer
{
    /**
     * @return ExceptionHandlerContract The handler for exceptions in the application.
     */
    public function getExceptionHandler(): ExceptionHandlerContract;

    /**
     * @return ServiceProviderContainerContract The container for all services.
     */
    public function getServices(): ServiceProviderContainerContract;

    /**
     * @return CommandCollectionContract The collection of commands registered in the application.
     */
    public function getCommands(): CommandCollectionContract;
}
