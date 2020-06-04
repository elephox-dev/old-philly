<?php
declare(strict_types=1);

namespace Philly\Container;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class UnacceptableBindingException.
 */
class UnacceptableBindingException extends InvalidArgumentException implements ContainerExceptionInterface
{
	/**
	 * UnacceptableBindingException constructor.
	 */
	public function __construct(string $type)
	{
		parent::__construct("Cannot accept bindings of objects with type '$type'");
	}
}
