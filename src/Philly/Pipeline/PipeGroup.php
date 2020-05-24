<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Philly\Contracts\Pipeline\PipeGroup as PipeGroupContract;
use Philly\Contracts\Pipeline\PostPipe as PostPipeContract;
use Philly\Contracts\Pipeline\PrePipe as PrePipeContract;

/**
 * Class PipeGroup
 */
class PipeGroup implements PipeGroupContract
{
	protected array $pre = [];

	protected array $post = [];

	protected string $name;

	/**
	 * PipeGroup constructor. Pass arrays for initial pre- and post-pipes.
	 */
	public function __construct(string $name, array $pre = [], array $post = [])
	{
		$this->name = $name;
		$this->pre = $pre;
		$this->post = $post;
	}

	/**
	 * @inheritDoc
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @inheritDoc
	 */
	public function pre(PrePipeContract $pipe): PipeGroupContract
	{
		$this->pre[] = $pipe;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function post(PostPipeContract $pipe): PipeGroupContract
	{
		$this->post[] = $pipe;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getPre(): array
	{
		return $this->pre;
	}

	/**
	 * @inheritDoc
	 */
	public function getPost(): array
	{
		return $this->post;
	}
}
