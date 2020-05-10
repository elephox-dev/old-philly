<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class PrePipeOutput
 */
class PostPipeOutput implements \Philly\Contracts\Pipeline\PostPipeOutput
{
	private bool $successful;
	private Response $result;

	/**
	 * PostPipeOutput constructor.
	 */
	public function __construct(bool $successful, Response $result)
	{
		$this->successful = $successful;
		$this->result = $result;
	}

	public function isSuccessful(): bool
	{
		return $this->successful;
	}

	public function getResult(): Response
	{
		return $this->result;
	}
}
