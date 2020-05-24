<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;

use Philly\Contracts\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface Pump
 */
interface Pump extends Pipe
{
    /**
     * @param Request $request
     * @return bool
     */
    public function accepts(Request $request): bool;

    /**
     * @param App $app The application container.
     * @param Request $request The request to handle.
     * @param callable $next Pass result to the next pipe in the pipeline.
     *
     * @return Response The resulting response.
     */
    public function handle(App $app, Request $request, callable $next): Response;

	/**
	 * @param PipeGroup $group A group of pipes to be attached to this pump.
	 *
	 * @return $this For method chaining.
	 */
    public function addGroup(PipeGroup $group): self;

	/**
	 * @param PrePipe $pipe A pipe to be attached before this pump.
	 *
	 * @return $this For method chaining.
	 */
    public function addPre(PrePipe $pipe): self;

	/**
	 * @param PostPipe $pipe A pipe to be attached after this pump.
	 *
	 * @return $this For method chaining.
	 */
    public function addPost(PostPipe $pipe): self;

	/**
	 * @return PrePipe[] All pipes which are attached before this pump.
	 */
    public function getPre(): array;

	/**
	 * @return PostPipe[] All pipes which are attached after this pump.
	 */
    public function getPost(): array;
}
