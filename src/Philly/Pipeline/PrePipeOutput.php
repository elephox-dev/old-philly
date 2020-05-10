<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PrePipeOutput
 */
class PrePipeOutput implements \Philly\Contracts\Pipeline\PrePipeOutput
{
	private bool $successful;

	/** @var Request|Response $result */
	private $result;

	/**
	 * PrePipeOutput constructor.
	 * @param Request|Response $result
	 */
	public function __construct(bool $successful, $result)
	{
		$this->successful = $successful;
		$this->result = $result;
	}

	public function isSuccessful(): bool
	{
		return $this->successful;
	}

	/**
	 * @return Request|Response
	 */
	public function getResult()
	{
		return $this->result;
	}
}
