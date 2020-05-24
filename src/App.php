<?php
declare(strict_types=1);

namespace Philly;

use Philly\Contracts\App as AppContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Exceptions\ExceptionHandler;

/**
 * Class App
 */
class App extends Container\BindingContainer implements AppContract
{
	/**
	 * @var array
	 */
	protected array $pipes = [];

	/**
	 * App constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// bind this app instance to its own class
		$this[AppContract::class] = $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getExceptionHandler(): ExceptionHandlerContract
	{
		if (!$this->has(ExceptionHandlerContract::class))
			$this->bind(ExceptionHandlerContract::class, new ExceptionHandler(), true);

		$handler = $this[ExceptionHandlerContract::class];

		assert($handler instanceof ExceptionHandlerContract, "Invalid exception handler type!");

		return $handler;
	}
}
