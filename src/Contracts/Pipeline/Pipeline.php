<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;

use Philly\Contracts\App;
use Philly\Contracts\Container\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface LinkerChain
 */
interface Pipeline extends Collection
{
    /**
     * @return JsonResponse
     */
    public function handle(App $app, Request $request): Response;

	/**
	 * @param Pump $pump The pump to be added to this pipeline.
	 *
	 * @return $this For method chaining.
	 */
    public function addPump(Pump $pump): self;

	/**
	 * @param PipeGroup $group The group of pipes to be added to this pipeline.
	 *
	 * @return $this For method chaining.
	 */
    public function addGlobal(PipeGroup $group): self;
}
