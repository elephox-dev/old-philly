<?php
declare(strict_types=1);

namespace Philly\Contracts;

use Philly\Contracts\Container\BindingContainer;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;

/**
 * Interface App
 */
interface App extends BindingContainer
{
	/**
	 * @return ExceptionHandlerContract The handler for exceptions in the application
	 */
	public function getExceptionHandler(): ExceptionHandlerContract;
}
