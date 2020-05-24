<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;

/**
 * Interface PipeGroup
 */
interface PipeGroup
{
	/**
	 * @return string The name of this pipe group. Pumps can access pipe groups via their name.
	 */
	public function getName(): string;

	/**
	 * @param PrePipe $pipe The pipe which should be used before the pump.
	 *
	 * @return $this For method chaining.
	 */
	public function pre(PrePipe $pipe): self;

	/**
	 * @param PostPipe $pipe The pipe which should be used after the pump.
	 *
	 * @return $this For method chaining.
	 */
	public function post(PostPipe $pipe): self;

	/**
	 * @return array The pipes which should be used before the pump.
	 */
	public function getPre(): array;

	/**
	 * @return array The pipes which should be used after the pump.
	 */
	public function getPost(): array;
}
