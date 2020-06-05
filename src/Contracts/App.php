<?php
declare(strict_types=1);

namespace Philly\Contracts;

use Philly\Contracts\Container\BindingContainer;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;

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
}
