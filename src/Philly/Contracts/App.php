<?php
declare(strict_types=1);

namespace Philly\Contracts;

use Philly\Contracts\Container\BindingContainer;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\Pipeline\Pipeline as PipelineContract;

/**
 * Interface App
 */
interface App extends BindingContainer
{
	/**
	 * @return PipelineContract The pipeline for handling incoming requests.
	 */
	public function getPipeline(): PipelineContract;

	/**
	 * @return ExceptionHandlerContract The handler for exceptions in the application
	 */
	public function getExceptionHandler(): ExceptionHandlerContract;
}
