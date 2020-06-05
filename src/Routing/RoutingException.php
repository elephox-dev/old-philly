<?php
declare(strict_types=1);

namespace Philly\Routing;

use RuntimeException;
use Throwable;

/**
 * Class RoutingException.
 */
class RoutingException extends RuntimeException
{
	public function __construct($message = "", $code = 0, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}
